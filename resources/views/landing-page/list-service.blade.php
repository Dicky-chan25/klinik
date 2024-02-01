{{-- modal-list-service --}}
<div id="modal-list-service" class="modal">
    <div class="modal__content__ls">
        <a href="#" class="modal__close">
            <div class="close-container">
                <img class="modal-btn-close" src="{{ asset('img/cross.png') }}" alt="close">
            </div>
        </a>
        <div class="modal-body">
            <p class="modal-title">Layanan Kami</p>

            <div class="ls-container">
                @foreach ($services as $ls)
                    <div class="ls-data ls-attr{{$ls->serviceId}} ls-item"
                    data-iddata="{{$ls->serviceId}}"
                    data-lstitle="{{$ls->nameService}}"
                    data-lstime="{{$ls->fromSchedule.'-'.$ls->toSchedule}}"
                    data-lsschedule="{{$ls->nameSchedule}}"
                    data-lsdoctor="{{$ls->name}}"
                    data-lsprice="{{$ls->price}}"
                    >
                        <div class="ls-thumb">
                            <img class="ls-img" src="https://www.shutterstock.com/image-photo/healthcare-medical-staff-concept-portrait-600nw-2281024823.jpg" alt="doctor">
                        </div>
                        <div class="ls-title">
                            <p class="title">{{$ls->nameService}}</p>
                            <p class="sub">{{$ls->name}}</p>
                        </div>
                        <div class="ls-title-value">
                            <p class="title">{{$ls->nameSchedule}}</p>
                            <p class="title">{{$ls->fromSchedule.'-'.$ls->toSchedule}}</p>
                        </div>
                        <div class="ls-choose{{$ls->serviceId}} ls-choose">
                            <img class="ls-choose-img" src="{{asset('img/check.png')}}" alt="choose">
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="modal-btn-bottom">
                <a class="modal-btn-secondary" href="#">Batal</a>
                <a class="modal-btn-primary choose-service" href="#">Pilih Layanan</a>
            </div>
        </div>
    </div>
</div>
{{-- modal-list-service --}}