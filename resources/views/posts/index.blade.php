<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    @if (session('status'))
    	<div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3">
	        {{ session('status') }}
	    </div>
	@endif
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <p class="font-semibold text-gray-900" >Click on badge to filter posts by category</p>
       @foreach($list as $item)
          <a href="{{ route('categoryFilter', $item->id) }}">
          <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-600/10">{{ $item->name }}</span></a>
      @endforeach
  </div>
  <section class="py-10">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 ">
      <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
      	@foreach($posts as $item)
        <article class="flex max-w-xl flex-col items-start justify-between border-solid border-2 border-gray-600 rounded bg-gray-50">
          <div class="relative mt-8 flex items-center gap-x-4">
            @foreach ($item->categories as $value)
                <a href="{{ route('categoryFilter', $value->id) }}">
                    <span class="inline-flex items-center rounded-md bg-cyan-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-cyan-600/10">{{ $value->name }}
                    </span>
                </a>
              @endforeach
          </div>
          <div class="group relative">
            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
              <a href="{{ route('posts.show', ['post'=> $item->id]) }}">
                <span class="absolute inset-0"></span>
                {{ $item->title }}
              </a>
            </h3>
            <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
            	{{ $item->body }}
            </p>
          </div>
          <div class="relative mt-8 flex items-center gap-x-4">
            <div class="text-sm leading-6">
              <p class="font-semibold text-gray-900">
                <p class="font-semibold text-gray-900">
                      <span class="absolute inset-0"></span>
                      By {{ $item->post_author }}
                  </p>
                   <p class="font-semibold text-gray-900">
                      <span class="absolute inset-0"></span>
                      Comments count: {{ $item->comment_count }}
                  </p>
            </div>
          </div>
          <div class="relative mt-8 flex items-center gap-x-4">
            <time datetime="2020-03-16" class="font-semibold text-gray-900">{{ $item->created_at }}</time>
          </div>
        </article>
        @endforeach
      </div>
    </div>
  </section>
</x-app-layout>