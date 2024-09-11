<x-app-layout>
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:justify-between sm:gap-4">
    <div>
      <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
        {{$post->title}}
      </h3>

      <p class="mt-1 text-xs font-medium text-gray-600">By John Doe</p>
    </div>

    <div class="hidden sm:block sm:shrink-0">
      <img
        alt=""
        src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1180&q=80"
        class="size-16 rounded-lg object-cover shadow-sm"
      />
    </div>
  </div>

  <div class="mt-4">
    <p class="text-pretty text-sm text-gray-500">
      {{$post->body}}
    </p>
  </div>

  <dl class="mt-6 flex gap-4 sm:gap-6">
    <div class="flex flex-col-reverse">
      <dt class="text-sm font-medium text-gray-600">Published  </dt>
      <dd class="text-xs text-gray-500">{{$post->created_at}}</dd>
    </div>
  </dl>


    <section class="py-24 relative">
      <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
        <div class="w-full flex-col justify-start items-start lg:gap-14 gap-7 inline-flex">
          <h2 class="text-gray-900 text-4xl font-bold font-manrope leading-normal">Comments</h2>
          <div class="w-full flex-col justify-start items-start gap-8 flex">
            <div
                class="w-full lg:p-8 p-5 bg-white rounded-3xl border border-gray-200 flex-col justify-start items-end gap-2.5 flex">
              <div class="w-full flex-col justify-start items-end gap-3.5 flex">
                  <div class="w-full justify-between items-center inline-flex">
                      <div class="w-full justify-start items-center gap-2.5 flex"> 
                          <div class="flex-col justify-start items-start gap-1 inline-flex">
                              <h5 class="text-gray-900 text-sm font-semibold leading-snug">{}
                              </h5>
                          </div>
                      </div>
                      <div class="group justify-end items-center flex">
                          <div
                              class="px-5 py-2.5 rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] border border-gray-400 hover:border-green-600 transition-all duration-700 ease-in-out  justify-center items-center flex">
                          </div>
                      </div>
                  </div>
                  <p class="text-gray-800 text-sm font-normal leading-snug"></p>
                  <div class="w-full justify-end items-start gap-6 inline-flex">
                      <button
                          class="sm:w-fit w-full px-5 py-2.5 rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] hover:bg-gray-200 hover:border-transparent transition-all duration-700 ease-in-out border border-gray-200 justify-center items-center flex">
                          <span
                              class="px-2 text-gray-900 text-base font-semibold leading-relaxed">Delete</span>
                      </button>
                      <button
                          class="sm:w-fit w-full px-5 py-2.5 bg-green-600 hover:bg-green-700 transition-all duration-700 ease-in-out rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex">
                          <span
                              class="px-2 py-px text-white text-base font-semibold leading-relaxed">Edit</span>
                      </button>

                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<div>

</x-app-layout>