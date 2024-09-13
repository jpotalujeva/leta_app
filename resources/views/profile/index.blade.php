<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
          @foreach($posts as $item)
          <article class="flex max-w-xl flex-col items-start justify-between text-wrap bg-gray-50 border-solid border-2 border-gray-600 rounded">
            <div class="flex items-center gap-x-4 text-xs">
              <time datetime="2020-03-16" class="text-gray-500">{{ $item->created_at }}</time>
              @foreach ($item->categories as $value)
                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-600/10">{{ $value->name }}</span>
              @endforeach
            </div>
            <div class="group relative">
              <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="{{ route('posts.show', ['post'=> $item->id]) }}">
                  <span class="absolute inset-0"></span>
                  {{ $item->title }}
                </a>
              </h3>
              <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600 text-wrap">
                {{ $item->body }}
              </p>
            </div>
            <div class="relative mt-8 flex items-center gap-x-4">
              <div class="text-sm leading-6">
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
          </article>
          @endforeach
        </div>
      </div>
</x-app-layout>
