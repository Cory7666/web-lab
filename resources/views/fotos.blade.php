@extends('app-template')

@section('styles')
    <link rel="stylesheet" href="/lib/css/fotos-styles.css" />
@endsection



@section('scripts')
    <script src="/lib/script/jquery/jquery.js"></script>

    <script type="module">
        import { Photo } from "/lib/script/Photo.js"
        import { setPhotos } from "/lib/script/init_PhotoTable.js"

        setPhotos(
            [
                new Photo("Image 1", "/lib/image/album/image1.png"),
                new Photo("Image 2", "/lib/image/album/image2.jpg"),
                new Photo("Image 3", "/lib/image/album/image3.jpg"),
                new Photo("Image 4", "/lib/image/album/image4.jpg"),
                new Photo("Image 5", "/lib/image/album/image5.jpg"),
                new Photo("Image 6", "/lib/image/album/image6.jpg"),
                new Photo("Image 7", "/lib/image/album/image7.jpg"),
                new Photo("Image 8", "/lib/image/album/image8.png"),
                new Photo("Image 9", "/lib/image/album/image9.jpg"),
                new Photo("Image 10", "/lib/image/album/image10.jpg"),
                new Photo("Image 11", "/lib/image/album/image11.png"),
                new Photo("Image 12", "/lib/image/album/image12.jpg"),
                new Photo("Image 13", "/lib/image/album/image13.jpg"),
                new Photo("Image 14", "/lib/image/album/image14.jpg"),
                new Photo("Image 15", "/lib/image/album/image15.jpg")
            ]
        );
    </script>
@endsection



@section('sidenav')
@endsection



@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Фотоальбом</h1>
        </div>
        <div class="card-content">
            <table>
                <tbody id="table-content">

                </tbody>
            </table>
            <div>
                {{ $additional_message }}
            </div>
        </div>
    </div>
@endsection
