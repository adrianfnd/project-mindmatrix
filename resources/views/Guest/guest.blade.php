@extends('Guest.layouts.app')

@section('title')
    Welcome to Tes Minat Bakat
@endsection

@section('content')
    <style>
        .hero-section {
            background: linear-gradient(45deg, #7c83fd, #596CFF);
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .result-list .card {
            transition: all 0.3s ease;
        }

        .result-list .card:hover {
            background-color: #f8f9fa;
        }
    </style>

    <div class="hero-section text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Temukan Potensi Terbaikmu</h1>
                    <p class="lead mb-4">Ikuti tes minat bakat gratis dan mulai perjalanan menuju karir impianmu!</p>
                    <button type="button" class="btn btn-light btn-lg" id="start-button">Pelajari Selengkapnya</button>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('assets/image_asset/landing.png') }}" alt="Hero Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5" id="jumbotron-description" style="display: none;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Apa itu Tes Minat Bakat?</h2>
                <p class="card-text lead">{{ $desc['desc_test'] }}</p>
                <button type="button" class="btn btn-primary btn-lg mt-3" id="start-quiz">Mulai Tes Gratis
                    Sekarang!</button>
            </div>
        </div>
    </div>

    <div id="question-section">
        <div class="container py-5" id="question-content">
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h2 class="text-center mb-4">Jawablah pertanyaan dibawah ini!</h2>
                    <h4 class="card-title mb-4" id="question-text">Testing Pertanyaan Defaults</h4>
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-outline-success btn-lg mx-2 answare-button"
                            data-answre="true">Gua Banget</button>
                        <button type="button" class="btn btn-outline-danger btn-lg mx-2 answare-button"
                            data-answre="false">Bukan Saya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="question-result" style="display:none;">
        <div class="container py-5">
            <h2 class="text-center mb-4">Hasil Tes Minat Bakat</h2>
            <div id="question-result-content" class="result-list">
            </div>
        </div>
        <div class="container d-flex justify-content-center mt-4 mb-4">
            <button type="button" class="btn btn-primary btn-lg" id="btn_create_user" style="display: none;"
                data-bs-toggle="modal" data-bs-target="#modal_create">Kirim Hasil</button>
        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="Login" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex justify-content-end me-2">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <h4 class="col text-center">Login</h4>
                            <div class="input-group has-validation my-2">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="example@email.com" required>
                                    <label for="email">Email</label>
                                </div>
                                <div class="invalid-feedback" id="email_error">
                                    Please choose a username.
                                </div>
                            </div>
                            <div class="input-group has-validation my-2">
                                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                                <div class="form-floating">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="password" required>
                                    <label for="password">Password</label>
                                </div>
                                <div class="invalid-feedback" id="password_error">
                                    Password salah
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary m-1">Login</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lengkapi Data Diri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guest.send_free_course') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div id="userForm"></div>
                        <div class="mb-3">
                            <label for="email_user" class="form-label">Email</label>
                            <input type="email" id="email_user" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <input type="hidden" id="password_user" name="password" value="12345678">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const questions = @json($soals->items());
            let currentQuestionsIndex = 0;
            let answares = [];
            let user = {};

            $('#question-section').hide();

            $('#start-button').click(function() {
                $('#jumbotron-description').show();
                $(this).hide();
            });

            $('#start-quiz').click(function() {
                $('#question-section')
                    .show();
                $('#jumbotron-description').hide();
                showQuestions();
            });

            function showQuestions() {
                if (currentQuestionsIndex < questions.length) {
                    const question = questions[currentQuestionsIndex].jawaban;
                    $('#question-text').text(question);
                } else {
                    $('#question-section').hide();
                    displayResult();
                    $('#btn_create_user').show();
                }
            }

            function displayResult() {
                $('#question-result').show();
                const resultContents = $('#question-result-content');
                resultContents.empty();
                answares.forEach((answer, index) => {
                    const questionText = questions.find(q => q.id === answer.question_id).jawaban;
                    const resultItem = `
        <div class="card mb-3">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h6 class="card-title mb-0">${questionText}</h6>
              </div>
              <div class="col-md-4 text-end">
                <span class="badge bg-${answer.answare ? 'success' : 'danger'} p-2">
                  ${answer.answare ? 'Gua Banget' : 'Bukan Saya'}
                </span>
              </div>
            </div>
          </div>
        </div>
      `;
                    resultContents.append(resultItem);
                });

                const resultForm = $('#userForm');
                resultForm.empty();
                answares.forEach((answer, index) => {
                    resultForm.append(
                        `<input type="hidden" name="pertanyaan[pertanyaan][${index}]" value="${answer.question_id}"/>`
                    );
                    resultForm.append(
                        `<input type="hidden" name="pertanyaan[jawaban][${index}]" value="${answer.answare}"/>`
                    );
                });
            }

            $(document).on('click', '.answare-button', function() {
                const answare = $(this).data('answre');
                answares.push({
                    question_id: questions[currentQuestionsIndex].id,
                    answare: answare
                });
                currentQuestionsIndex++;
                showQuestions();
            });
        });
    </script>
@endsection
