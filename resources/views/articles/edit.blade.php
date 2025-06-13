<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between">
        	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            	Role / edit
	        </h2>
	        <a href="{{route('articles.index')}}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2">back</a>
        </div>
	</x-slot>
	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:py-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900">
					<form action="{{route('articles.update',$article->id)}}" method="post">
						@csrf
						<label class="text-lg font-medium"><h3><b>Title</b></h3></label>
						<input value="{{old('title',$article->title)}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" type="text" name="title" placeholder="Enter title">
						@error('title')
							<p class="text-red-400 font-medium">{{$message}}</p>
						@enderror

						<label class="text-lg font-medium"><h3><b>Content</b></h3></label>
						<textarea name="text" id="text" cols="30" rows="10" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Content">{{ old('text', $article->text) }}</textarea>

						<label class="text-lg font-medium"><h3><b>Author</b></h3></label>
						<input value="{{old('author',$article->author)}}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" type="text" name="author" placeholder="Author">
						@error('author')
							<p class="text-red-400 font-medium">{{$message}}</p>
						@enderror
						<br><br>
						<button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>


	