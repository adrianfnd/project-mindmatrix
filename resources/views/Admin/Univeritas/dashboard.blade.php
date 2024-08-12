@extends('Admin.Template.app')
@section('title')
Univeritas > Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-10">
            <form action="{{route('admin.univeritas.dashboard', ['limit_per_page' => 8])}}" method="get">
                @csrf
                @method('GET')
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Recipient's username"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <input type="hidden" name="limit_per_page" value="10" />
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            
        </div>
        <div class="col-2 d-flex justify-content-end align-items-start">
            <a href="{{route('admin.univeritas.dashboard.create.page')}}" type="button"
                class="btn btn-primary w-100">Create Univeritas</a>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @if($universitas->total() != 0)
            @foreach ($universitas as $value)
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col">
                                    @if($value['image_logo'] == null)
                                        <img src="https://stmik-amikbandung.ac.id/wp-content/uploads/2021/05/putih-300x285.png"
                                            class="card-img-top" alt="logo_universitas" width="30">
                                    @else
                                        <img src="{{$value['image_logo']}}" class="card-img-top" alt="logo_universitas" width="30">
                                    @endif
                                </div>
                                <div class="col d-flex align-items-center justify-content-center">
                                    <h5>{{$value['nama_kampus']}}</h5>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col text-start">
                                    <p class="truncatedText">{{$value['alamat']}}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col text-start">
                                    <p>Akreditas : <b>{{$value['akreditasi']}}</b></p>
                                </div>
                            </div>
                            <button type="button" class="rounded rounded-pill btn btn-primary w-100 mb-3">Detail</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Repeat for other cards -->
    </div>
    <div class="col d-flex justify-content-center ">
        {{$universitas->links('Layout.Pagination.pagination_card')}}

    </div>

</div>
@endsection
@section('script')
<script>
    function truncateText(text, wordLimit) {
        const words = text.split(' ');
        console.log(text);

        if (words.length <= wordLimit) {
            return text;
        }

        return words.slice(0, wordLimit).join(' ') + '...';
    }
    const elements = document.querySelectorAll('.truncatedText');
    elements.forEach(element => {
        const fullText = element.textContent;
        element.textContent = truncateText(fullText, 15);
    });
</script>
@endsection