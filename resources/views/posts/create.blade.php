<style type="text/css">
    [x-cloak] {
        display: none;
    }

    .svg-icon {
        width: 1em;
        height: 1em;
    }

    .svg-icon path,
    .svg-icon polygon,
    .svg-icon rect {
        fill: #333;
    }

    .svg-icon circle {
        stroke: #4691f6;
        stroke-width: 1;
    }
</style>
<x-app-layout>
  <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <form class="w-full max-w-lg"  action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input hidden id="user_id" type="text" name="user_id" value="{{auth()->user()->id}}">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Title
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Enter your title" name="title">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
        Content
      </label>
      <textarea class="resize-x rounded-mb appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" name="body" placeholder="Enter content" style="resize: both; !important">
      </textarea> 
    </div>
  </div>

  <div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
        Category
      </label>
        <select x-cloak id="select">
           @foreach ($categories as $option)
            <option value={{ $option->id }} > {{ $option->name }}</option>
          @endforeach
        </select>

        <div x-data="dropdown()" x-init="loadOptions()" class="w-full md:w-1/2 flex flex-col items-center mx-auto">
          <input name="values" type="hidden" x-bind:value="selectedValues()">
          <div class="inline-block relative w-64">
            <div class="flex flex-col items-center relative">
              <div x-on:click="open" class="w-full">
                <div class="my-2 p-1 flex border border-gray-200 bg-white rounded">
                  <div class="flex flex-auto flex-wrap">
                    <template x-for="(option,index) in selected" :key="options[option].value">
                      <div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded bg-gray-100 border">
                        <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                        <div class="flex flex-auto flex-row-reverse">
                          <div x-on:click.stop="remove(index,option)">
                            <svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
                              <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                   c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                   l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                   C14.817,13.62,14.817,14.38,14.348,14.849z" />
                            </svg>

                          </div>
                        </div>
                      </div>
                    </template>
                    <div x-show="selected.length == 0" class="flex-1">
                      <input placeholder="Select a option" class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedValues()">
                    </div>
                  </div>
                  <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                    <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                      <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                        <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
          c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
          L17.418,6.109z" />
                      </svg>

                    </button>
                    <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                      <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                        <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                    c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                    " />
                      </svg>

                    </button>
                  </div>
                </div>
              </div>
              <div class="w-full px-4">
                <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                  <div class="flex flex-col w-full overflow-y-auto">
                    <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                      <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
                        <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                          <div class="w-full items-center flex justify-between">
                            <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                            <div x-show="option.selected">
                              <svg class="svg-icon" viewBox="0 0 20 20">
                                <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
                      C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
                      L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button
        class="bg-green-600 hover:bg-green-700 transition-all duration-700 ease-in-out rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center">
        <span
            class="px-2 py-px text-white text-base font-semibold leading-relaxed">Post</span>
    </button>
      <script type="text/javascript">
        function dropdown() {
                      return {
                          options: [],
                          selected: [],
                          show: false,
                          open() { this.show = true },
                          close() { this.show = false },
                          isOpen() { return this.show === true },
                          select(index, event) {

                              if (!this.options[index].selected) {

                                  this.options[index].selected = true;
                                  this.options[index].element = event.target;
                                  this.selected.push(index);

                              } else {
                                  this.selected.splice(this.selected.lastIndexOf(index), 1);
                                  this.options[index].selected = false
                              }
                          },
                          remove(index, option) {
                              this.options[option].selected = false;
                              this.selected.splice(index, 1);


                          },
                          loadOptions() {
                              const options = document.getElementById('select').options;
                              for (let i = 0; i < options.length; i++) {
                                  this.options.push({
                                      value: options[i].value,
                                      text: options[i].innerText,
                                      selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                                  });
                              }


                          },
                          selectedValues(){
                              return this.selected.map((option)=>{
                                  return this.options[option].value;
                              })
                          }
                      }
                  }
      </script>
  </div>
    
  </form>
</div>
</x-app-layout>