<!-- modal Login -->
<div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="Login" aria-hidden="false" >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row d-flex justify-content-end me-2">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{route('login.send')}}" method="post">
            @csrf
            @method('POST')
            <div class="row">
              <h4 class="col text-center">Login</h4>
              <div class="input-group has-validation my-2">
                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                <div class="form-floating">
                  <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" required>
                  <label for="email">Email</label>
                </div>
                <div class="invalid-feedback" id="email_error">
                  Please choose a username.
                </div>
              </div>
              <div class="input-group has-validation my-2">
                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                <div class="form-floating">
                  <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
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
  <!-- end modal login -->