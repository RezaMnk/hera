@extends('home.layouts.app')

@section('title', 'درباره ما')

@section('breadcrumb')
    <x-breadcrumb title="درباره ما" desc="درباره تهیه غذای قریشی" />
@endsection

@section('content')
    <!-- about section -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9 my-5 about-section">
                <div class="about-text">
                    <h2>
                        معرفی شرکت
                    </h2>
                    <div class="text-parts">
                        <p>
                            گروه غذایی قریشی با سال ها سابقه درخشان در زمینه تهیه و توزیع غدای تشریفات، مجالس ، کنفرانس ها و اجلاس ها که مدیون 50سال فعالیت خانوادگی میباشد ، هم اکنون با ورود به حوزه غذا شرکتی و سازمانی  مثل گذشته توانسته سهم بسزایی از بازار را  به خود اختصاس دهد البته در این راستا بکار گیری نیروهای زبده و متخصص در حوزه فروش ، تولید و پشتیبانی و همچنین توسعه آشپزخانه مرکزی با جدید ترین دستگاه های تولید و بسته بندی از نظر بهداشتی و استاندارد های بین المللی مطابق با متد روز دنیا خالی از لطف نمی باشد.
                        </p>
                        <p>
                            در حال حاظر شرکت پندار نو قریشی آمادگی  عقد قرارداد با شرکت ها و سازمان ها حداقل 20 پرس تا 10000در هر وعده غذایی با قیمت کارشناسی را دارا میباشد.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-3 d-none d-lg-block about-image" style="background-image: url('{{ asset('assets/img/building.png') }}')"></div>
        </div>
    </div>
    <!-- end about section -->
@endsection
