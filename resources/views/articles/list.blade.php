<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	{{ __('Articles') }}
	        </h2>
            @can('edit articles')
	        <a href="{{route('articles.create')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">Create</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        	<x-message></x-message>
            <table class="w-full">
            	<thead class="bg-gray-50">
            		<tr class="border-b">
            			<th class="px-6 py-3 text-left">Sr No.</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Author</th>
            			<th class="px-6 py-3 text-left">Created</th>
                        @can('edit articles')
            			<th class="px-6 py-3 text-center">Action</th>
                        @endcan
            		</tr>
            	</thead>
            	<tbody class="bg-white">
            	   @if($article->isnotEmpty())
                    @foreach($article as $user)
                        <tr class="border-b">
                            <td class="px-6 py-3 text-left">{{$loop->iteration+ ($article->currentPage() - 1) * $article->perPage()}}</td>
                            <td class="px-6 py-3 text-left">{{$user->title}}</td>
                            <td class="px-6 py-3 text-left">{{$user->author}}</td>
                            <td class="px-6 py-3 text-left">{{\Carbon\Carbon::parse($user->created_at)->format('d M,Y')}}</td>
                            @can('edit articles')
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center space-x-4">
                                    <a href="{{ route('articles.edit', $user->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                                    @can('delete articles')
                                    <a href="{{ route('articles.destory', $user->id) }}" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-600">Delete</a>
                                    @endcan
                                </div>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                    @endif
            	</tbody>
            </table>
        </div>
    </div>
</x-app-layout>
