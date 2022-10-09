@extends('backend.layouts.app')

@section('style')
<style>
  #sig-canvas {
border: 2px dotted #CCCCCC;
border-radius: 15px;
cursor: crosshair;
}
</style>
@endsection

@section('breadcumb')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item"><a href="{{ route('backend.master-data.index') }}">Master Data</a></li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('backend.users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Absen Edit</h3>
            </div>
            <form action="{{ route('backend.absen.update', $absen->id) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf

                <div class="card-body">

                    @include('backend.components.form-message')
                  
                    <div class="form-group mb-3">
                        <label class="col-form-label">Person</label>
                        <select class="form-select" id="type" name="name">
                            <option value="">Select person</option>
                            <option value="REZA BIMATARA" {{ $absen->name == 'REZA BIMATARA' ? 'selected' : '' }}>REZA BIMATARA</option>
                            <option value="YUDI PRATOMY" {{ $absen->name == 'YUDI PRATOMY' ? 'selected' : '' }}>YUDI PRATOMY</option>
                            <option value="WISNU NUGROHO" {{ $absen->name == 'WISNU NUGROHO' ? 'selected' : '' }}>WISNU NUGROHO</option>
                            <option value="SYAHRUL ALIF" {{ $absen->name == 'SYAHRUL ALIF' ? 'selected' : '' }}>SYAHRUL ALIF</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                      <label class="col-form-label">Site</label>
                      <select class="form-select" id="type" name="site">
                          <option value="">Select Site</option>
                          <option value="Sunter" {{ $absen->site == 'Sunter' ? 'selected' : '' }}>Sunter</option>
                          <option value="Jayakarta" {{ $absen->site == 'Jayakarta' ? 'selected' : '' }}>Jayakarta</option>
                          <option value="Cikupa" {{ $absen->site == 'Cikupa' ? 'selected' : '' }}>Cikupa</option>
                      </select>
                  </div>

                    <div class="form-group mb-3">
                        <label for="date">date</label>
                        <input class="form-control @error('date') is-invalid @enderror" id="date" type="date" name="date" placeholder="Tanggal WO " required value="{{ old('date') ?? $absen->date }}">

                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Signature</label><br>
                        <canvas id="sig-canvas" width="550" height="250">
                            Get a better browser, bro.
                        </canvas>
                        <br>
                        <span class="fs-5 d-none" id="notif_signature">
                            <strong>Signature Added!</strong>
                        </span>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="hidden" name="signature" id="signature_value">
                    </div>
                    <span class="btn btn-primary" id="sig-submitBtn">Submit Signature</span>
				            <span class="btn btn-default" id="sig-clearBtn">Clear Signature</span>
                    {{-- <img id="sig-image" src="" alt="Your signature will go here!"/> --}}
                    
                    <div class="form-group mb-3">
                      <label for="" class="form-label">Current Signature</label>
                      <br>
                      <img src="{{ asset('storage/'. $absen->ttd .'.jpg') }}" alt="" class="img-fluid">
                    </div>

                    <div class="form-group mb-3">
                      <label for="description">Description</label>
                      <textarea name="description" class="form-control" rows="3" placeholder="Description">{{ $absen->description }}</textarea>

                      @error('description')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>

                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" id="submit_button" class="btn btn-success btn-footer">Save</button>
                    <a href="{{ route('backend.absen.index') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    (function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, { passive: false });

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, { passive: false });

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, { passive: false });

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, { passive: false });

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, { passive: false });

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, { passive: false });

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, { passive: false });

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, { passive: false });
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, { passive: false });
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, { passive: false });

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
    document.getElementById('notif_signature').classList.add('d-none')
    document.getElementById("signature_value").value = "";
    // sigText.innerHTML = "Data URL for your signature will go here!";
    // sigImage.setAttribute("src", "");
  }, false);
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    // sigText.innerHTML = dataUrl;
    // sigImage.setAttribute("src", dataUrl);
    document.getElementById('notif_signature').classList.remove('d-none')
    document.getElementById("signature_value").value = dataUrl;
    console.log(dataUrl);
  }, false);

})();
</script>
@endsection