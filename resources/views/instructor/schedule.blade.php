<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Schedule a Class
        </h2>
    </x-slot>



    <div class="flex space-x-4">
        <div class="flex-1 bg-blue-500 p-4"></div>
        
        <div class="flex-1 bg-green-500 p-4">
            <form action="{{ route('schedule.store') }}" method="post" class="max-w-lg">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="text-sm">Select type of class</label>
                        <select name="class_type_id" class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500">
                            @foreach ($class_types as $classType)
                            <option value="{{ $classType->id }}">{{ $classType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-6">
                        <div class="flex-1">
                            <label class="text-sm">Date</label>
                            <input type="date" name="date" class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500" min="{{ date('Y-m-d', strtotime('tomorrow')) }}">
                        </div>
                        <div class="flex-1">
                            <label class="text-sm">Time</label>
                            <select type="time" name="time" class="block mt-2 w-full border-gray-300 focus:ring-0 focus:border-gray-500">
                                <option value="05:00:00">5 am</option>
                                <option value="06:00:00">6 am</option>
                                <option value="07:00:00">7 am</option>
                                <option value="08:00:00">8 am</option>
                                <option value="17:00:00">5 pm</option>
                                <option value="18:00:00">6 pm</option>
                                <option value="19:00:00">7 pm</option>
                                <option value="20:00:00">8 pm</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        @error('date_time')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <x-primary-button>Schedule</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
        <div class="flex-1 bg-red-500 p-4"></div>
    </div>
      



</x-app-layout>