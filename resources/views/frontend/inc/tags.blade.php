@php
    if(session()->get('language') == 'english'){
        $tags = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
    }else{
        $tags = App\Models\Product::groupBy('product_tags_bn')->select('product_tags_bn')->get();
    }
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach ($tags as $tag)
                @php
                    $strs = session()->get('language') == 'english' ? $tag->product_tags_en : $tag->product_tags_bn;
                @endphp
                <a class="item" title="Phone" href="{{route('tags.pdoruct', $strs)}}">{{$strs}}</a> 
            @endforeach
        </div>
    </div>
</div>