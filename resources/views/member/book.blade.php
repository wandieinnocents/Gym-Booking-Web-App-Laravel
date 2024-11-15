<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Book a class
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 max-w-2xl divide-y">
                    @forelse ($scheduled_classes as $class)
                  <div class="py-6">
                     <div class="flex gap-6 justify-between">
                        <div>
                           <p class="text-2xl font-bold text-purple-700">{{ $class->class_type->name }}</p>
                           <p class="text-sm">{{ $class->instructor->name }}</p>
                           <p class="text-sm">{{ $class->class_type->description }}</p>

                           <span class="text-slate-600 text-sm">{{ $class->class_type->minutes }} minutes</span>
                        </div>
                        <div class="text-right flex-shrink-0">
                           <p class="text-lg font-bold">{{ $class->date_time->format('g:i a') }}</p>
                           <p class="text-sm">{{ $class->date_time->format('jS M') }}</p>
                        </div>
                     </div>

                     <div class="mt-1 text-right">
                        <form method="post" action="{{ route('booking.store') }}">
                           @csrf
                           <input type="hidden" name="scheduled_class_id" value="{{ $class->id }}"> 
                           <x-primary-button class="px-3 py-1">Book</x-primary-button>
                        </form>
                     </div>
                  </div>
                  @empty
                  <div>
                     <p>No classes scheduled</p>
                     
                  </div>
                  @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
