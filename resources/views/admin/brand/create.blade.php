@extends('admin.include.master')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush
@section('body')
<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-12">
            <div class="widget-box">
                <div class="widget-header">
                    <h4 class="widget-title">Description</h4>
                </div>
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="green col-sm-3 control-label no-padding-right" for="form-field-1">Long Description:</label>
                                    <div class="col-sm-9">
                                        <!-- Long Description content here -->
                                        <div class="widget-box">
                                            <div class="widget-body">
                                                <div class="widget-main no-padding">
                                                    <textarea name="long_description" id="summernote" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit">Submit</button>
</form>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> --}}
<!-- Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script><script>
    $('#summernote').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
@endpush
