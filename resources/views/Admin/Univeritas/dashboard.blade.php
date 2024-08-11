@extends('Admin.Template.app')
@section('title')
Univeritas > Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-10">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Recipient's username"
                    aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <div class="col-2 d-flex justify-content-end align-items-start">
            <button type="button" class="btn btn-primary w-100">Create Univeritas</button>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <img src="https://stmik-amikbandung.ac.id/wp-content/uploads/2021/05/putih-300x285.png"
                                class="card-img-top" alt="..." style="background-color: black;" width="30">
                        </div>
                        <div class="col d-flex align-items-center justify-content-center">
                            <h5>Univeritas A</h5>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col text-start">
                            <p class="truncatedText">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea non
                                minus
                                officiis cumque molestias ratione facere iure? Perferendis sunt est cum impedit, ipsam
                                cumque quia quo consectetur? Et, accusantium fugit.</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-start">
                            <p>Akreditas : <b>A</b></p>
                        </div>
                    </div>
                    <button type="button" class="rounded rounded-pill btn btn-primary w-100 mb-3">Detail</button>
                </div>
            </div>
        </div>
        <!-- Repeat for other cards -->
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