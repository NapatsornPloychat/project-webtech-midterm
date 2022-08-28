@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6">
            Edit post
        </h1>

        <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Post Title
                </label>
                @if ($errors->has('title'))
                    <p class="text-red-600">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <input type="text" name="title" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title', $post->title) }}"
                       placeholder="" required @if(Auth::user()->role == 'STAFF') readonly @endif>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category </label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="tags" value="{{ old('tags', $tags) }}"
                        placeholder="" autocomplete="on" @if(Auth::user()->role == 'STAFF') disabled @endif>
                    <option value="การลงทะเบียน" {{ old('tags', $tags) == 'การลงทะเบียนเรียน' ? 'selected' : ''}}>การลงทะเบียน</option>
                    <option value="อุปกรณ์ในห้องเรียน" {{ old('tags', $tags) == 'อุปกรณ์ในห้องเรียน' ? 'selected' : ''}}>อุปกรณ์ในห้องเรียน</option>
                    <option value="สิ่งแวดล้อมในมหาวิทยาลัย" {{ old('tags', $tags) == 'สิ่งแวดล้อมในมหาวิทยาลัย' ? 'selected' : ''}}>สิ่งแวดล้อมในมหาวิทยาลัย</option>
                    <option value="รถโดยสารภายในมหาวิทยาลัย" {{ old('tags', $tags) == 'รถโดยสารภายในมหาวิทยาลัย' ? 'selected' : ''}}>รถโดยสารภายในมหาวิทยาลัย</option>
                    <option value="บุคลากร" {{ old('tags', $tags) == 'บุคลากร' ? 'selected' : ''}}>บุคลากร</option>
                    <option value=อื่นๆ" {{ old('tags', $tags) == 'อื่นๆ' ? 'selected' : ''}}>อื่นๆ</option>
                </select>
            </div>



            <div class="relative z-0 mb-6 w-full group">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                    Post Description
                </label>
                @error('description')
                <p class="text-red-600">
                    {{ $message }}
                </p>
                @enderror
                <textarea rows="4" type="text" name="description" id="description"
                          class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          required @if(Auth::user()->role == 'STAFF') readonly @endif>{{ old('description', $post->description) }}</textarea>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    Post Contact
                </label>
                @if ($errors->has('contact'))
                    <p class="text-red-600">
                        {{ $errors->first('contact') }}
                    </p>
                @endif
                <input type="text" name="contact" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('contact', $post->contact) }}"
                       placeholder="" required @if(Auth::user()->role == 'STAFF') readonly @endif>
            </div>




            <div class="form-group">

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Update image</label>
                <input type="file" name="image"
                       class="bg-gray-50 border @error('contact') border-red-600 @else border-gray-300 @enderror text-gray-900"
                       value="{{'image',($post->image)}}" placeholder="" @if(Auth::user()->role == 'STAFF') disabled @endif>



            </div>
<br>
            @if(Auth::user()->role === 'STAFF')
            <div class="relative z-0 mb-6 w-full group">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Status </label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="status" value="{{ old('status', $post->status) }}"
                        placeholder="" autocomplete="on">
                    <option value="รอดำเนินการ" {{ old('status', $post->status) == 'รอดำเนินการ' ? 'selected' : ''}}>รอดำเนินการ</option>
                    <option value="กำลังดำเนินการ" {{ old('status', $post->status) == 'กำลังดำเนินการ' ? 'selected' : ''}}>กำลังดำเนินการ</option>
                    <option value="เสร็จสิ้น" {{ old('status', $post->status) == 'เสร็จสิ้น' ? 'selected' : ''}}>เสร็จสิ้น</option>

                </select>
            </div>
            @endif

            <div>
                <button class="app-button" type="submit">Edit</button>
            </div>

        </form>
    </section>


    @can('delete', $post)
    <section class="mx-8 mt-16">
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-b border-red-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-red-500">Danger Zone</span>
            </div>
        </div>

        <div>
            <h3 class="text-red-600 mb-4 text-2xl">
                Delete this Post
                <p class="text-gray-800 text-xl">
                    Once you delete a post, there is no going back. Please be certain.
                </p>
            </h3>

            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="relative z-0 mb-6 w-full group">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        Post Title to Delete
                    </label>
                    <input type="text" name="title" id="title"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="" required>
                </div>
                <button class="app-button red" type="submit">DELETE</button>
            </form>
        </div>
    </section>
    @endcan
@endsection
