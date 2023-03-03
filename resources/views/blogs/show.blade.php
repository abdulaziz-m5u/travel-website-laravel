@extends('layouts.frontend')

@section('content')
 <!--==================== HOME ====================-->
 <section>
        <div class="swiper-container gallery-top">
          <div class="swiper-wrapper">
            <section class="islands swiper-slide">
              <img src="{{ Storage::url($blog->image) }}" alt="" class="islands__bg" />

              <div class="islands__container container">
                <div class="islands__data">
                  <h2 class="islands__subtitle">{{ $blog->title }}</h2>
                  <h1 class="islands__title">{{ date('d M Y',strtotime($blog->created_at)) }}</h1>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>

      <!-- blog -->
      <section class="blog section" id="blog">
        <div class="blog__container container">
          <div class="content__container">
            <div class="blog__detail">
              {!! $blog->description !!}
              <div class="blog__footer" style="margin-top: 2rem;">
                <div class="blog__reaction">{{ date('d M Y', strtotime($blog->created_at)) }}</div>
                <div class="blog__reaction">
                  <i class="bx bx-show"></i>
                  <span>{{ $blog->reads }}</span>
                </div>
              </div>
            </div>
            <div class="package-travel">
              <h3>Favorite Places</h3>
              <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('blog.category', $category->slug) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
              </ul>
              <h3 style="margin-bottom: 1rem">Popular Trip</h3>
              @foreach($travel_packages as $travel_package)
                <article class="popular__card" style="margin-bottom: 1rem">
                  <a href="{{ route('travel_package.show', $travel_package->slug) }}">
                    <img
                      src="{{ Storage::url($travel_package->galleries->first()->images) }}"
                      alt=""
                      class="popular__img"
                    />
                    <div class="popular__data">
                      <h2 class="popular__price"><span>$</span>{{ number_format($travel_package->price,2) }}</h2>
                      <h3 class="popular__title">{{ $travel_package->location }}</h3>
                      <p class="popular__description">{{ $travel_package->type }}</p>
                    </div>
                  </a>
                </article>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      <section class="blog" id="blog">
        <div class="blog__container container">
          <span class="section__subtitle" style="text-align: center"
            >Related Blog</span
          >
          <h2 class="section__title" style="text-align: center">
            Find The Best Places
          </h2>

          <div class="blog__content grid">
            @foreach($relatedBlogs as $relatedBlog)
            <article class="blog__card">
              <div class="blog__image">
                <img src="{{ Storage::url($relatedBlog->image) }}" alt="" class="blog__img" />
                <a href="{{ route('blog.show', $relatedBlog->slug) }}" class="blog__button">
                  <i class="bx bx-right-arrow-alt"></i>
                </a>
              </div>

              <div class="blog__data">
                <h2 class="blog__title">{{ $relatedBlog->title }}</h2>
                <p class="blog__description">
                  {{ $relatedBlog->excerpt }}
                </p>

                <div class="blog__footer">
                  <div class="blog__reaction">{{ date('d M Y', strtotime($relatedBlog->crated_at)) }}</div>
                  <div class="blog__reaction">
                    <i class="bx bx-show"></i>
                    <span>{{ $relatedBlog->reads }}</span>
                  </div>
                </div>
              </div>
            </article>
            @endforeach
          </div>
        </div>
      </section>
@endsection

@push('style-alt')
<style>
  blockquote {
    border-left: 8px solid #b4b4b4;
    padding-left: 1rem;
  }
  .blog__detail ul li {
    list-style: initial;
  }
</style>
@endpush