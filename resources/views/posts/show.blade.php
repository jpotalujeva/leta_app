<x-app-layout>
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <div class="sm:flex ">
    @foreach($categories as $badge)
   <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{ $badge->name }}</span>
    @endforeach
  </div>
  <div class="sm:flex sm:justify-between sm:gap-4">
    <div>
      <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
        {{ $post->title }}
      </h3>

      <p class="mt-1 text-xs font-medium text-gray-600">By {{ $post_author->name }}</p>
    </div>
  </div>

  <div class="mt-4">
    <p class="text-pretty text-sm text-gray-500">
      {{ $post->body }}
    </p>
  </div>

  <dl class="mt-6 flex gap-4 sm:gap-6">
    <div class="flex flex-col-reverse">
      <dt class="text-sm font-medium text-gray-600">{{ $post->created_at }}</dt>
      <dd class="text-xs text-gray-500">Published</dd>
    </div>
  </dl>

  <div>
    @if(auth()->user()->id == $post->user_id)
    <div class="w-full justify-end items-start gap-6 inline-flex">
      <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
          <button
              class="sm:w-fit w-full px-5 py-2.5 rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] hover:bg-gray-200 hover:border-transparent transition-all duration-700 ease-in-out border border-gray-200 justify-center items-center flex">
              <span class="px-2 text-gray-900 text-base font-semibold leading-relaxed">Delete</span>
          </button>
        </form>

        <a href="{{ route('posts.edit', $post->id) }}" class="sm:w-fit w-full px-5 py-2.5 bg-green-600 hover:bg-green-700 transition-all duration-700 ease-in-out rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex" role="button">
          Edit
        </a>
    </div>
    @endif
  </div>


    <section class="py-24 relative">
      <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
        <div class="w-full flex-col justify-start items-start lg:gap-14 gap-7 inline-flex">
          <h2 class="text-gray-900 text-4xl font-bold font-manrope leading-normal">Comments</h2>
          <div class="w-full flex-col justify-start items-start gap-8 flex">
            <div
                class="w-full lg:p-8 p-5 bg-white rounded-3xl border border-gray-200 flex-col justify-start items-end gap-2.5 flex">
                @if ($comments) 
                  @foreach($comments as $comm)
                    <div class="w-full flex-col justify-start items-end gap-3.5 flex">
                        <div class="w-full justify-between items-center inline-flex">
                            <div class="w-full justify-start items-center gap-2.5 flex"> 
                                <div class="flex-col justify-start items-start gap-1 inline-flex">
                                  <div class="fw-bold">{{ $names[$comm->id] }}</div>
                      
                                    <h5 class="text-gray-900 text-sm font-semibold leading-snug">
                                      {{ $comm->comment }}
                                    </h5>
                                </div>
                            </div>
                            @if ($comm->user_id == Auth::user()->id)
                        <div class="w-full justify-end items-start gap-6 inline-flex">
                            <form action="{{ route('comments.destroy', $comm->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                              <button
                                  class="sm:w-fit w-full px-5 py-2.5 rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] hover:bg-gray-200 hover:border-transparent transition-all duration-700 ease-in-out border border-gray-200 justify-center items-center flex">
                                  <span class="px-2 text-gray-900 text-base font-semibold leading-relaxed">Delete</span>
                              </button>
                            </form>
                        </div>
                        @endif
                        </div> 
                    </div>
                @endforeach
              @endif
            </div>
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

        <div x-data="{ modelOpen: false }">
            <button @click="modelOpen =!modelOpen" class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>

                <span>Add Comment</span>
            </button>

              <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                  <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                      <div x-cloak @click="modelOpen = false" x-show="modelOpen" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0" 
                          x-transition:enter-end="opacity-100"
                          x-transition:leave="transition ease-in duration-200 transform"
                          x-transition:leave-start="opacity-100" 
                          x-transition:leave-end="opacity-0"
                          class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                      ></div>

                      <div x-cloak x-show="modelOpen" 
                          x-transition:enter="transition ease-out duration-300 transform"
                          x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                          x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                          x-transition:leave="transition ease-in duration-200 transform"
                          x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                          x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                          class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                      >
                          <div class="flex items-center justify-between space-x-4">
                              <h1 class="text-xl font-medium text-gray-800 ">Add comment</h1>
                              <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                              </button>
                          </div>
                          <form class="mt-5" action="{{ route('comments.store') }}" method="POST">
                             @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                              <input type="hidden" name="post_id" value="{{ $post->id }}">
                              <div>
                                  <label for="comment" class="block text-sm text-gray-700 capitalize dark:text-gray-200">Comment</label>
                                  <input type="text" class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40" name="comment">
                              </div>
                              <div class="flex justify-end mt-6">
                                  <button type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                      Add
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
        </div>  
              
            </div>
          </div>
        </div>
      </div>
    </section>
<div>
</x-app-layout>