@php
    
echo json_encode([
    "result" => $result,
    "comment" => "<pre>".$authorEmail."says: ".$text."</pre>",
]);

@endphp
