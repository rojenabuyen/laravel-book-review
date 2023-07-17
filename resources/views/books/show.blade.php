@extends('layouts.app')

@section('content')
  <div class="mb-4">
    <h1 class="mb-2 text-2xl">{{ $book->title }}</h1>

    <div class="book-info">
      
      <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
      <div class="book-rating flex items-center">
        <div class="mr-2 text-sm font-medium text-slate-700">
          
          <x-star-rating :rating="$book->reviews_avg_rating" />
        </div>
        <span class="book-review-count text-sm text-gray-500">
          {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
        </span>
      </div>
    </div>
  </div>

  <div class="mb-4 items-center">
    <a href="{{ route('books.reviews.create', $book) }}" class="btn">
      Add a review!</a>
    <a href="{{ route('books.index', $book) }}" class="mb-4 btn">
      Return</a>
  </div>

  <div x-data="{ flash:true }">
    @if (session()->has('success'))
    <div x-show="flash"
    class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700" 
    role="alert">
        <strong class="font-bold">Review Added!</strong>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="1.5" @click="flash = false"
              stroke="currentColor" class="h-6 w-6 cursor-pointer">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    </div>
    @endif
</div>
  <div>
    <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
    <ul>
      @forelse ($book->reviews as $review)
        <li class="book-item mb-4">
          <div>
            <div class="mb-2 flex items-center justify-between">
              <div class="font-semibold">
                <x-star-rating :rating="$review->rating" />
              </div>
              <div class="book-review-count">
                {{ $review->created_at->format('M j, Y') }}</div>
            </div>
            <p class="text-gray-700">{{ $review->review }}</p>
          </div>
        </li>
      @empty
        <li class="mb-4">
          <div class="empty-book-item">
            <p class="empty-text text-lg font-semibold">No reviews yet</p>
          </div>
        </li>
      @endforelse
    </ul>
  </div>
@endsection