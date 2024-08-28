@extends('layouts.app')

@section('title', $service->title)
@section('page-title', $service->title)

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
@endsection

@section('content')
    @include('app.components.stat-headers')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12 mb-3">
                            <img src="{{ Storage::url($service->logo) }}" class="img-fluid detail-page-image" alt="{{ $service->title }}">
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12 col-12 mb-3">
                            <div class="d-flex flex-column gap-3">
                                <h3>{{ $service->title }}</h2>
                                <p>{{ $service->short_desc }}</p>
                                <h1 class="text-primary">{{ $service->price }} €</h1>
                                <a href="{{ route('services.purchase', $service->id) }}" class="btn btn-secondary purchase-btn">Buy Now</a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="detail-page-tabs" id="nav-tab" role="tablist">
                                <div class="detail-page-link active" id="nav-features-tab" data-bs-toggle="tab" data-bs-target="#nav-features" type="button" role="tab" aria-controls="nav-features" aria-selected="true">Features</div>
                                <div class="detail-page-link" id="nav-reviews-tab" data-bs-toggle="tab" data-bs-target="#nav-reviews" type="button" role="tab" aria-controls="nav-reviews" aria-selected="false">Reviews</div>
                            </div>
                            <div class="tab-content detail-page-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-features" role="tabpanel" aria-labelledby="nav-features-tab" tabindex="0">
                                    {!! $service->description !!}
                                </div>
                                <div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab" tabindex="0">
                                    @if (!$service->reviews()->where('user_id', Auth::user()->id)->exists())
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                                <h2 class="section-title text-center">Write your Review</h2>
                                                <form action="{{ route('services.review', $service->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="star-rating">
                                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"><i class="fas fa-star"></i></label>
                                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"><i class="fas fa-star"></i></label>
                                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"><i class="fas fa-star"></i></label>
                                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"><i class="fas fa-star"></i></label>
                                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"><i class="fas fa-star"></i></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea name="comment" class="form-control" rows="5" placeholder="Write your comment" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-secondary w-100">Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Reviews (Average: {{ number_format($service->reviews()->avg('rating'), 1) }})</h4>
                                            @foreach ($service->reviews as $review)
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="fas fa-star text-warning"></i>
                                                                @else
                                                                    <i class="far fa-star text-warning"></i>
                                                                @endif
                                                            @endfor
                                                        </h5>
                                                        <p class="card-text">{{ $review->comment }}</p>
                                                        <p class="card-text"><small class="text-muted">By {{ $review->user->name }} on {{ $review->created_at->format('M d, Y') }}</small></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
