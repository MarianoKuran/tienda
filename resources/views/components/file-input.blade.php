<div class="md:w-[50%] mt-4 md:m-0">
    <form action="/profile/update-profile-photo" method="post" id="component-input-file-form" enctype="multipart/form-data">
        @csrf
        <div class="md:mx-4">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Seleccione foto de Perfil</label>
            <div id="preview-file-container" class="flex justify-center p-2 border border-2 border-dashed cursor-pointer">
                @if (Auth::user() != null && Auth::user()->profile_photo != null)
                    <img src="{{asset(Auth::user()->profile_photo)}}" id="img-preview" class="h-[200px] md:h-[250px] md:w-[230px] border rounded" alt="imagen de perfil">
                @else
                    <img src="{{asset('/images/single-image-placeholder.png')}}" id="img-preview" class="h-[200px] md:h-[250px] md:w-[230px] border rounded" alt="imagen de perfil">
                @endif
            </div>
            <input type="file" name="file" id="component-input-file" hidden>
            <div class="text-green-400 font-bold">
                @if (session()->has('success'))
                    <i class="fa fa-thumbs-up"></i>
                    {{session()->get('success')}}
                @endif
            </div>
        </div>
    </form>
</div>