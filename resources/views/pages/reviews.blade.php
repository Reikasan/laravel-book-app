<x-app>
    <x-book-searchbar />
    <div class="review-container">
        <div class="year-tabs">
            <div class="year-tabs__container">
            @foreach($readMonth as $year => $months)
                <a 
                    class="{{$year == $selectedYear ? 'tab tab--active' : 'tab'}}"
                    href="{{route('reviews.indexByYear', ['year' => $year])}}">
                    {{ $year }}
                </a>
            @endforeach
            </div>
            <div class="line"></div>
        </div>
        @if($reviews->count() !== 0)
            @foreach($readMonth as $year => $months)
            <!-- If the year is the current year, then display the review data -->
                @if($year == $selectedYear)
                    @foreach($months as $month)
                        <!-- Sort the reviews by month and year -->
                        <div class="review-rows">
                            <div class="review-rows__header">
                                @if($year == now()->format('Y') && $month == now()->format('F'))
                                <h1>This Month</h1>
                                @else
                                <h1>{{ $month }}</h1>
                                @endif
                                <div class="count">:
                                    @if(!isset($reviews[$month. '.'.$year]))
                                        0 Book
                                    @elseif(count($reviews[$month. '.'.$year]) == 1)
                                        1 Book
                                    @else
                                        {{count($reviews[$month. '.'.$year])}} Books
                                    @endif 
                                </div>
                            </div>
                            <div class="review-row">
                                @if(isset($reviews[$month. '.'.$year]))
                                    @foreach($reviews[$month. '.'.$year] as $review) 
                                        {{-- @if($review->monthAndYear == now()->format('F.Y')) --}}
                                            <x-review-card :review="$review"/>
                                        {{-- @endif --}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        @else
            <h1>No Reviews Found</h1>
        @endif
    </div>
</x-app>