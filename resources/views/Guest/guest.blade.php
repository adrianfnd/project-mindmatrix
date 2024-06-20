@extends('Guest.layouts.app')
@section('title')
Welcome
@endsection
@section('content')
<div class="my-5">
  <div id="jumbo-tron">
    <div class="container py-5">
      <div class="row">
        <div class="col text-center">
          <h1 class="text-body-emphasis " id="jumbotron-title">Test Minat Bakat</h1>
          <button type="button" class="btn btn-primary btn-lg " id="start-button">Apa itu ? </button>
        </div>
      </div>
      <div class="row" id="jumbotron-description" style="display: none;">
        <div class="col text-start">
          <p class="col mx-auto lead">
            {{$desc['desc_test']}}
          </p>
          <button type="button" class="btn btn-primary btn-lg " id="start-quiz">Yuk Test Gratis Loh !</button>
        </div>
      </div>
    </div>
  </div>
  <div id="question-result" style="display:none;">
    <div class="container py-5" id="question-result-content">

    </div>
    <div class="container d-flex justify-content-end">
      <button type="button" class="btn btn-primary" id="btn_create_user" style="display: none;" data-bs-toggle="modal"
        data-bs-target="#modal_create">Send Jawaban</button>
    </div>
  </div>
  <div id="question-section" style="display: none;">
    <div class="container py-5" id="question-content">
      <div class="row text-center">
        <h6 id="question-text">Testing Pertanyaan Defaults</h6>
        <div class="col">
          <button type="button" class="btn btn-success answare-button" data-answre="true">Gua Banget</button>
          <button type="button" class="btn btn-danger answare-button" data-answre="false">Bukan Saya</button>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="modal_create" data-backdrop="static" tabindex="-1" role="dialog"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <form action="{{route('guest.send_free_course')}}" method="POST">
          @csrf
          @method('POST')
          <div id="userForm">
          </div>
          <div class="container-fluid">
            <div class="row mb-3">
              <div class="col d-flex justify-content-end">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" id="email_user" name="email" class="form-control" placeholder="Email">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="tanggal lahir" format="d-m-Y">
              </div>
              <input type="hidden" id="password_user" name="password" value="12345678">
            </div>
            <div class="row justify-content-between">
              <button type="submit" class="btn btn-success">Upload</button>
              <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function () {
    const questions = @json($soals->items());
    let currentQuestionsIndex = 0;
    let answares = [];
    let user = {};
    $('#start-button').click(function () {
      $('#jumbotron-description').show();
      $('#start-button').hide();
    });
    $('#start-quiz').click(function () {
      $('#jumbo-tron').hide();
      $('#question-section').show();
      showQuestions();
    });
    function showQuestions() {
      if (currentQuestionsIndex < questions.length) {
        const question = questions[currentQuestionsIndex].jawaban;
        $('#question-text').text(question);
      } else {
        $('#question-section').hide();
        $('#btn_create_user').show();
      }
    }
    function displayResutl() {
      $('#question-result').show();
      const resutlContents = $('#question-result-content');
      resutlContents.empty();
      answares.forEach((answer, index) => {
        const questionText = questions.find(q => q.id === answer.question_id).jawaban;
        const resutlItem = `
              <div class="row d-flex align-items-center jutify-content-start">
                <div class="col mb-3">
                    <h6 class="m-0 p-0">${questionText}</h6>
                </div>
                <div class="col mb-3 text-end">
                  <button type="button" class="btn btn-success result-button" data-result="true"  ${answer.answare ? '' : 'style="display:none"'} disabled>Gua banget</button>
                  <button type="button" class="btn btn-danger result-button" data-result="false" ${answer.answare ? 'style="display:none"' : ''} disabled>Bukan Saya</button>
                </div>
              </div>
          `;
        resutlContents.append(resutlItem);
      });
      const resutlForm = $('#userForm');
      resutlForm.empty();
      answares.forEach((answer,index) => {
          resutlForm.append(`<input type="hidden" name="pertanyaan[pertanyaan][${index}]" value="${answer.question_id}"/>`);
          resutlForm.append(`<input type="hidden" name="pertanyaan[jawaban][${index}]" value="${answer.answare}"/>`);
      });

    }
    $(document).on('click', '.answare-button', function () {
      const answare = $(this).data('answre');
      answares.push({
        question_id: questions[currentQuestionsIndex].id,
        answare: answare
      });
      currentQuestionsIndex++;
      displayResutl();
      showQuestions();
    });
    
  })
</script>
@endsection