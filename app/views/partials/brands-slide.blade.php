<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <div class="brand-list">
                        @foreach($brands as $b)
						<li>
							<a href="{{ URL::to('tienda/productos/marcas/'.$b->id) }}">
								<img src="{{ asset('images/brands/'.$b->logo) }}" class="img-responsive brand-logo center-block" alt="" />
							</a>
						</li>
						@endforeach                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->