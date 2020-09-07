@extends('layout.main')

@section('content')


        <!-- Page Content
        ================================================== -->
        <div class="full-page-container">

            <div class="full-page-sidebar">
                <div class="full-page-sidebar-inner" data-simplebar>
                    <form method="GET" action="/articles">
                         <div class="sidebar-container">

                            <!-- Location -->
                            <div class="sidebar-widget">
                                <h3>Location</h3>
                                <div class="input-with-icon">
                                    <div id="autocomplete-container">
                                        <input id="autocomplete-input" name="place" type="text" placeholder="Location" value="{{request()->place}}">
                                    </div>
                                    <i class="icon-material-outline-location-on"></i>
                                </div>
                            </div>


                            <!-- Keywords -->
                            <div class="sidebar-widget">
                                <h3>Keywords</h3>
                                <div class="keywords-container">
                                        <div class="keyword-input-container">
                                            <input type="text" name="name" class="keyword-input" placeholder="e.g. job title" value="{{request()->name}}">
                                        </div>
                                    <div class="keywords-list"><!-- keywords go here --></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="sidebar-widget">
                                <h3>Category</h3>
                                <select class="selectpicker default" multiple data-selected-text-format="count" name="category_types[]" data-size="7" title="All Categories" >
{{--                                    <option name="admin-support">Admin Support</option>--}}
{{--                                    <option name="customer-service">Customer Service</option>--}}
{{--                                    <option name="data-analytics">Data Analytics</option>--}}
{{--                                    <option name="design-creative">Design & Creative</option>--}}
{{--                                    <option name="legal">Legal</option>--}}
{{--                                    <option name="software-developing">Software Developing</option>--}}
{{--                                    <option name="it-networking">IT & Networking</option>--}}
{{--                                    <option name="writing">Writing</option>--}}
{{--                                    <option name="translation">Translation</option>--}}
{{--                                    <option name="sales-marketing">Sales & Marketing</option>--}}
                                    @foreach(\App\Category::all() as $category)
                                        <option name="{{$category->name}}" @if(in_array($category->label, request('category_types',[]))) selected @endif>{{ $category->label  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Job Types -->
                            <div class="sidebar-widget">
                                <h3>Job Type</h3>

                                <div class="switches-list">
                                    @foreach(\App\Job::all() as $job)
                                        <div class="switch-container">
                                            <label class="switch"><input type="checkbox" name="job_types[]" value="{{ $job->name  }}" @if(in_array($job->name, request('job_types',[]))) checked @endif ><span class="switch-button"></span> {{ $job->label  }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Salary -->
                            <div class="sidebar-widget">
                                <h3>Salary</h3>
                                <div class="margin-top-55"></div>

                                <!-- Range Slider -->
                                <input class="range-slider" type="text" value="" name="slider" data-slider-currency="$" data-slider-min="1500" data-slider-max="15000" data-slider-step="100" data-slider-value="[1500,15000]"/>
                            </div>

                            <!-- Tags -->
                            <div class="sidebar-widget">
                                <h3>Tags</h3>
                                <div class="tags-container">
                                    @foreach(\App\Tag::all() as $tag)
                                        <div class="tags-container">
                                            <div class="tag">
                                                <input type="checkbox" id="tag{{$tag->id}}" name="tag_types[]" value="{{ $tag->name  }}" @if(in_array($tag->name, request('tag_types',[]))) checked @endif />
                                                <label for="tag{{$tag->id}}">{{ $tag->label  }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                            </div>
                         </div>

                         <!-- Sidebar Container / End -->

                         <!-- Search Button -->
                         <div class="sidebar-search-button-container">
                             <button type="submit" class="button ripple-effect">Search</button>
                         </div>
                         <!-- Search Button / End-->
                    </form>
                </div>
            </div>
            <!-- Full Page Sidebar / End -->

            <!-- Full Page Content -->
            <div class="full-page-content-container" data-simplebar>
                <div class="full-page-content-inner">

                    <h3 class="page-title">Search Results</h3>

                    <div class="notify-box margin-top-15">
                        <div class="switch-container">
                            <a href="/send" style=":hover { border-bottom: 1px solid #1d68a7; color: #333;}">Turn on email alerts for this search</a>
{{--                            <label class="switch"><input type="checkbox" name="mail"><span class="switch-button"></span><span class="switch-text">Turn on email alerts for this search</span></label>--}}
                        </div>
{{--                        onclick="location.reload()"--}}
                        <div class="sort-by">
                            <span>Sort by:</span>
                            <select class="selectpicker hide-tick">
                                <option>Relevance</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                                <option>Random</option>
                            </select>
                        </div>
                    </div>

                    <div class="listings-container grid-layout margin-top-35">
                    @if(count($articles) > 0)
                        @foreach($articles as $el)
                    <!-- Job Listing -->
                        <a href="/articles/{{$el->id}}" class="job-listing">

                            <!-- Job Listing Details -->
                            <div class="job-listing-details">
                                <!-- Logo -->
                                <div class="job-listing-company-logo">
                                    <img src="/storage/images/{{$el->logo}}" alt="">
                                </div>

                                <!-- Details -->
                                <div class="job-listing-description">
                                    <h4 class="job-listing-company">{{$el->name}}
                                        @if($el->verified == true)

                                        <span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span>
                                        @endif
                                    </h4>
                                    <h3 class="job-listing-title">{{$el->title}}</h3>
                                </div>
                            </div>

                            <!-- Job Listing Footer -->
                            <div class="job-listing-footer">
                                <span class="bookmark-icon"></span>
                                <ul>
                                    <li><i class="icon-material-outline-location-on"></i> {{$el->place}}</li>
                                    <li><i class="icon-material-outline-business-center"></i>
{{--                                        @foreach(\App\Job::all() as $job)--}}

{{--                                              {{ $job->label  }}--}}

{{--                                        @endforeach--}}
                                    </li>
                                    <li><i class="icon-material-outline-account-balance-wallet"></i>${{$el->payment}}</li>
                                    <li><i class="icon-material-outline-access-time"></i>
                                        <?php
                                            $update_at_day =  e($el->updated_at);
                                            $current_day = date('d-m-Y');
                                            $first_date_transform = strtotime($update_at_day);
                                            $second_date_transform = strtotime($current_day);
                                            $interval = $second_date_transform-$first_date_transform;
                                            $interval = $interval/(60*60*24);
                                            echo $interval;
                                        ?>

                                        days ago

                                    </li>
                                </ul>
                            </div>
                        </a>
                             @endforeach
                        @else
                            <p>Статей пока нет</p>
                        @endif
                    </div>
                </div>
                    {{$articles->links("pagination::custom-pg")}}
            </div>
        </div>

@endsection
