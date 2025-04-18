@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    {{-- <p>Welcome to this beautiful admin panel .</p> --}}

    <div class="card-body">
        <form>
          <div class="row">
            <div class="col-sm-6">
              <!-- text input -->
              <div class="form-group">
                <label>Text</label>
                <input type="text" class="form-control" placeholder="Enter ...">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Text Disabled</label>
                <input type="text" class="form-control" placeholder="Enter ..." disabled>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <!-- textarea -->
              <div class="form-group">
                <label>Textarea</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Textarea Disabled</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
              </div>
            </div>
          </div>

          <!-- input states -->
          <div class="form-group">
            <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
              success</label>
            <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
              warning</label>
            <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
          </div>
          <div class="form-group">
            <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
              error</label>
            <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
          </div>

          <div class="row">
            <div class="col-sm-6">
              <!-- checkbox -->
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox">
                  <label class="form-check-label">Checkbox</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" checked>
                  <label class="form-check-label">Checkbox checked</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" disabled>
                  <label class="form-check-label">Checkbox disabled</label>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <!-- radio -->
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="radio1">
                  <label class="form-check-label">Radio</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="radio1" checked>
                  <label class="form-check-label">Radio checked</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" disabled>
                  <label class="form-check-label">Radio disabled</label>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <!-- select -->
              <div class="form-group">
                <label>Select</label>
                <select class="form-control">
                  <option>option 1</option>
                  <option>option 2</option>
                  <option>option 3</option>
                  <option>option 4</option>
                  <option>option 5</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Select Disabled</label>
                <select class="form-control" disabled>
                  <option>option 1</option>
                  <option>option 2</option>
                  <option>option 3</option>
                  <option>option 4</option>
                  <option>option 5</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <!-- Select multiple-->
              <div class="form-group">
                <label>Select Multiple</label>
                <select multiple class="form-control">
                  <option>option 1</option>
                  <option>option 2</option>
                  <option>option 3</option>
                  <option>option 4</option>
                  <option>option 5</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Select Multiple Disabled</label>
                <select multiple class="form-control" disabled>
                  <option>option 1</option>
                  <option>option 2</option>
                  <option>option 3</option>
                  <option>option 4</option>
                  <option>option 5</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>

@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@endpush
