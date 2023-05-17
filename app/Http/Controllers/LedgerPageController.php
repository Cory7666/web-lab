<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLedgerCommentFromFile;
use App\Http\Requests\CreateLedgerCommitFromForm;
use Illuminate\Http\Request;

use App\Models\LedgerComment;
use App\Models\SpyingRecord;
use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

use function Termwind\render;

class MyCsvBuilder extends Builder
{
    private string $filepath;

    public bool $is_data_set = false;
    public array $data = [];

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
        $this->readFromCsv();
    }

    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $page = $page ?: Paginator::resolveCurrentPage($pageName);
        $total = func_num_args() === 5 ? value(func_get_arg(4)) : $this->getCountForPagination();
        $perPage = $perPage instanceof Closure ? $perPage($total) : $perPage;
        $results = $total ? array_slice($this->getData(), ($page - 1) * $perPage, $perPage) : collect();

        return $this->paginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);
    }

    public function getCountForPagination($columns = ['*'])
    {
        return count($this->getData());
    }

    public function getData(): array
    {
        if ($this->is_data_set) {
            return $this->data;
        } else {
            $this->readFromCsv();
            return $this->data;
        }

        return $this->data;
    }

    private function readFromCsv()
    {
        $this->data = [];
        $fd = fopen($this->filepath, 'r');
        $header = fgetcsv($fd);

        while (($data = fgetcsv($fd)) !== FALSE) {
            $model = new LedgerComment();

            $model->id = $data[0];
            $model->firstname = $data[1];
            $model->lastname = $data[2];
            $model->email = $data[3];
            $model->body_text = $data[4];
            $model->created_at = $data[5];
            $model->updated_at = $data[6];

            array_push($this->data, $model);
        }
        usort($this->data, function (LedgerComment $a, LedgerComment $b) {
            if ($a->created_at == $b->created_at) {
                return 0;
            }
            return ($a->created_at < $b->created_at) ? 1 : -1;
        });
        $this->is_data_set = true;
    }
}

class LedgerPageController extends Controller
{
    private static string $filepath = '/home/alex/Projects/Web/university-project/database/ledger_comments.csv';
    private static int $perPageCommentCount = 20;

    public function onGetRequest(Request $r, string $responseType = '.html')
    {
        SpyingRecord::spy_stealthily($r);
        $builder = new MyCsvBuilder(LedgerPageController::$filepath);

        switch ($responseType) {
            case ".json":
                return response()->json(LedgerComment::orderBy('created_at', 'desc')->paginate(LedgerPageController::$perPageCommentCount));
            default:
                render(json_encode($builder->data));

                return view(
                    'ledger',
                    [
                        "page_title" => "Книга отзывов",
                        "internal_path" => "/ledger/",

                        #'comments' => LedgerComment::paginate(LedgerPageController::$perPageCommentCount)
                        'comments' => $builder->paginate(LedgerPageController::$perPageCommentCount),
                    ]
                );
        }
    }

    public function onAddNew(Request $r)
    {
        if (Auth::check()) {
            if ($r->hasFile('uploaded_file')) {
                $file = $r->file('uploaded_file');
                $fd = fopen($file->openFile()->getPathname(), 'r');
                $header = fgetcsv($fd);

                while (($line = fgetcsv($fd)) !== FALSE) {
                    LedgerComment::create([
                        "firstname" => $line[0],
                        "lastname" => $line[1],
                        "email" => $line[2],
                        "body_text" => $line[3],
                    ]);
                }

                return redirect("/");
            } else if ($r->has('text')) {
                $curr_user = Auth::user();
                LedgerComment::create([
                    'firstname' => $curr_user->firstname,
                    'lastname' => $curr_user->lastname,
                    'email' => $curr_user->email,
                    'body_text' => $r->get('text'),
                ]);
                return redirect("/");
            } else {
                return back()->withErrors(["Ожидается комментарий."]);
            }
        } else {
            return back()->withErrors(["Вы должны бать зарегистрированы."]);
        }
    }

    public function onAddRecordsFromFile(CreateLedgerCommentFromFile $r)
    {
        $file = $r->file('uploaded_file');
        $fd = fopen($file->openFile()->getPathname(), 'r');
        $header = fgetcsv($fd);

        while (($line = fgetcsv($fd)) !== FALSE) {
            $comment = LedgerComment::create([
                "firstname" => $line[0],
                "lastname" => $line[1],
                "email" => $line[2],
                "body_text" => $line[3],
            ]);
            $this->addRecord($comment);
        }

        return redirect("/ledger");
    }

    public function onAddOneRecord(CreateLedgerCommitFromForm $r)
    {
        $curr_user = Auth::user();
        $comment = LedgerComment::create([
            'firstname' => $curr_user->firstname,
            'lastname' => $curr_user->lastname,
            'email' => $curr_user->email,
            'body_text' => $r->get('text'),
        ]);
        $this->addRecord($comment);
        return redirect("/ledger");
    }

    private function addRecord(LedgerComment $record)
    {
        $fd = fopen(LedgerPageController::$filepath, 'a');
        fseek($fd, 0, SEEK_END);
        fputcsv($fd, [
            $record->id,
            $record->firstname,
            $record->lastname,
            $record->email,
            $record->body_text,
            $record->created_at,
            $record->updated_at,
        ]);
        fclose($fd);
    }
}
