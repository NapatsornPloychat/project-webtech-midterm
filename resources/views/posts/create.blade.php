@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6">
            Add new post
        </h1>

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf

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
                       class="bg-gray-50 border @error('title') border-red-600 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('title') }}"
                       placeholder="" required>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category </label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="tags", id="tags">
{{--                    <option selected>select category</option>--}}
                    <option value="การลงทะเบียน">การลงทะเบียน</option>
                    <option value="อุปกรณ์ในห้องเรียน">อุปกรณ์ในห้องเรียน</option>
                    <option value="สิ่งแวดล้อมในมหาวิทยาลัย">สิ่งแวดล้อมในมหาวิทยาลัย</option>
                    <option value="รถโดยสารภายในมหาวิทยาลัย">รถโดยสารภายในมหาวิทยาลัย</option>
                    <option value="บุคลากร">บุคลากร</option>
                    <option value="อื่นๆ">อื่นๆ</option>

                </select>
            </div>

{{--            <div class="relative z-0 mb-6 w-full group">--}}
{{--                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">--}}
{{--                    Tags (separated by comma)--}}
{{--                </label>--}}
{{--                <input type="text" name="tags" id="tags"--}}
{{--                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"--}}
{{--                       placeholder="" autocomplete="off">--}}
{{--            </div>--}}

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
                          required >{{ old('description') }}</textarea>
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
                       class="bg-gray-50 border @error('contact') border-red-600 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                       value="{{ old('contact') }}"
                       placeholder="" required>
            </div>




            <div class="form-group">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">อัพเดตรูปภาพ</label>
                @if ($errors->has('image'))
                    <p class="text-red-600">
                        {{ $errors->first('image') }}
                    </p>
                @endif
                <input type="file" name="image"
                       class="bg-gray-50 border @error('contact') border-red-600 @else border-gray-300 @enderror text-gray-900"
                       value="{{ old('image') }}" placeholder="" required>


            </div>


{{--            <div class="block">--}}
{{--                <div class="mt-2">--}}
{{--                    <label class="inline-flex items-center">--}}
{{--                        <input type="checkbox" for="user_id" />--}}
{{--                        <span class="ml-2" value="anonymous">Anonymous mode</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="flex items-center mb-6 mt-6">
                <input id="default-checkbox" type="checkbox" name="anonymous" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="default-checkbox" class="ml-2">Anonymous mode</label>
            </div>




            <div>
                <button class="app-button" type="submit">Create</button>
            </div>


        </form>
    </section>

@endsection
