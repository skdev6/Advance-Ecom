<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            @php
                $categores = App\Models\Category::orderBy('category_name_en', "ASC")->get();
            @endphp
            @foreach ($categores as $category)
            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="{{$category->category_icon}} tx-20" style="margin-right:11px;"></i>{{session()->get('language') == 'english' ? $category->category_name_en : $category->category_name_bn}}
                </a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            @php
                                $subCategores = App\Models\SubCategory::where('categories_id', '=', $category->id)->orderBy('category_name_en', 'ASC')->get()
                            @endphp
                            @foreach ($subCategores as $subCategory_item)
                            @php
                                $subSubCategores = App\Models\SubSubCategory::where('subcategory_id', '=', $subCategory_item->id)->orderBy('subsubcategory_name_en', 'ASC')->get()
                            @endphp
                            <div class="col-sm-12 col-md-3">
                                <h6>{{$subCategory_item->category_name_en}}</h6>
                                <ul class="links list-unstyled">
                                    @foreach ($subSubCategores as $subSubCategores_item)
                                        <li><a href="#">{{$subSubCategores_item->subsubcategory_name_en}}</a></li>  
                                    @endforeach
                                </ul>
                            </div>  
                            @endforeach
                        </div>
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            @endforeach
            <!-- /.menu-item -->
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>