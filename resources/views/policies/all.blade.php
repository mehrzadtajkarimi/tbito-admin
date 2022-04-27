@component('layouts.include.content' , ['title' => 'قوانین'])

@slot('breadcrumb')
<li class="breadcrumb-item "><a href="#">پنل مدیریت</a></li>
<li class="breadcrumb-item active">قوانین</li>
@endslot
@section('sidebar-policies','active')
@section('sidebar-contents','active menu-open')

<div class="col-12 ">

    <form action="{{route('policies.update')}}" method="post">
        @csrf
        @method('PUT')
        <div class="card card-info card-outline">
            <div class="card-body  m-4">
                <div class="mb-3">
                    <textarea id="editor1" name="editor1" style="width: 100%">لطفا متن مورد نظر خودتان را وارد کنید</textarea>
                </div>
                </p>
                <div class="">
                    <button type="submit" class="btn btn-info  btn-block mb-3">ذخیره اطلاعات</button>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </form>
</div>
<script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(function(editor) {
                // The editor instance
            })
            .catch(function(error) {
                console.error(error)
            })
    })
</script>
<script src="{{ asset('/admin/plugins/ckeditor/ckeditor.js') }}"></script>


@endcomponent