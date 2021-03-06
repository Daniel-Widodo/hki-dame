<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <form action="{{url('keluarga')}}" method="post">
                    @method('POST')
                    @csrf
                    <div class="container">
                        <label for="kepala_keluarga" class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input id="jemaat_sugestion" type="text" name="kepala_keluarga" value="{{old('kepala_keluarga')}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"/>
                        <div class="row z-10" id="match-list"></div>
                        @error('kepala_keluarga')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <input name="kepala_keluarga_id" id="kepala_keluarga_id" type="hidden" value="38ff3696-15ed-4f68-a44f-1d8c03fed5c2">
                    @error('kepala_keluarga_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="hubungan" class="block text-black mt-3 font-bold">Hubungan Dalam Keluarga</label>
                    <select name="hubungan" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Hubungan Dalam Keluarga">
                        <option @if (old('hubungan') == "Suami") {{"selected"}}@endif value='Suami' >Suami</option>
                        <option @if (old('hubungan') == "Istri") {{"selected"}}@endif value='Istri'>Istri</option>
                        <option @if (old('hubungan') == "Anak") {{"selected"}}@endif value='Anak'>Anak</option>
                        <option @if (old('hubungan') == "Famili Lain") {{"selected"}}@endif value='Famili Lain'>Famili Lain</option>
                    </select>
                    @error('hubungan')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="sektor_id" class="block text-black mt-3 font-bold">Sektor</label>
                    <select id="sektor_id" name="sektor_id" class="lg:w-1/2 sm:w-full h-10 pl-3 pr-6 text-base placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Sektor">
                        <option value="" disabled selected>Pilih Sektor</option>
                        @foreach ($sektors as $sektor)
                            <option @if (old('sektor_id') == $sektor->id) {{"selected"}}@endif value="{{$sektor->id}}" >{{$sektor->nama}}</option>
                        @endforeach
                    </select>
                    @error('sektor_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="no_keluarga" class="block text-black mt-3 font-bold">No. Keluarga</label>
                    <input id="no_keluarga" type="text" name="no_keluarga" value="{{old('no_keluarga', '819410')}}" placeholder="mis : 81941008001" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                    @error('no_keluarga')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat Rumah</label>
                    <textarea type="text" name="alamat_rumah" value="{{old('alamat_rumah')}}" placeholder="Jln. Maleber Barat ..." class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full" autocomplete="off"></textarea>
                    @error('alamat_rumah')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <label for="status_rumah" class="block text-black mt-3 font-bold">Status Tempat Tinggal</label>
                    <input type="radio" class="form-radio h-5 w-5 text-gray-600" name="status_rumah" value="Tetap" @if (old('status_rumah') == "Tetap") {{"checked"}}@endif />
                    <span class="ml-2 text-gray-700">Tetap</span>
                    <input type="radio" class="form-radio h-5 w-5 ml-8 text-gray-600" name="status_rumah" value="Sementara" @if (old('status_rumah') == "Sementara") {{"checked"}}@endif />
                    <span class="ml-2 text-gray-700">Sementara</span>
                    @error('status_rumah')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                    <div class="clear-both py-5"></div>

                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>

                    <x-back-button :link="url('/keluarga')"/>

                </form>

            </div>
        </div>
    </div>
    

    <script>
    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("jemaat_sugestion");
    const keluargaIdInput = document.getElementById("kepala_keluarga_id");

    const url = window.location.origin + '/api/jemaat/'
    searchInput.oninput = async ()=> getJemaat();

    const setSearchValue = (jemaatNama, jemaatId) => {
        searchInput.value = jemaatNama;
        keluargaIdInput.value = jemaatId;
        matchList.innerHTML = '';
    }
    
    
    const outputHtml = matches => {

        if (matches.length>0){
            const htmlFetched = matches.map(match => `
                <div onclick="setSearchValue('${match.nama}', '${match.id}')" class="cursor-pointer p-2 bg-gray-200 hover:bg-gray-300 border border-gray-400">
                    <p><strong>${match.nama}</strong> - ${match.tanggal_lahir}</p>
                </div>
            `).join('');
            matchList.innerHTML = htmlFetched;
        } else matchList.innerHTML = '';
    }

    async function getJemaat(){
        var x = document.getElementById("jemaat_sugestion");
        if(x.value.length > 1){
            x.value = x.value.toLowerCase();
            const response = await fetch(url+x.value);
            outputHtml(await response.json());
        }
        else matchList.innerHTML = '';
    }

    window.addEventListener('click', function(e){   
        if (!document.getElementById('body').contains(e.target)){
            matchList.innerHTML = '';
        }
    });

/* ------------------------------ */

    const url_noKeluarga = window.location.origin + '/api/noKeluarga/'

    const sektorInput = document.getElementById("sektor_id");
    const noKeluargaInput = document.getElementById("no_keluarga");

    sektorInput.onchange = async ()=> getNoKeluarga();

    async function getNoKeluarga(){
        var x = document.getElementById("sektor_id");
        var sektor_code = x.options[x.selectedIndex].text;
        const response = await fetch(url_noKeluarga+x.value);
        noKeluargaInput.value = '819410'+sektor_code.substr(sektor_code.length - 2)+await response.json();
    }
    </script>
</x-app-layout>
