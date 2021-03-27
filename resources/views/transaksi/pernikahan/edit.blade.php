<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Data Kelahiran/Angkat Anak') }}
        </h2>
    </x-slot>

    <div class="py-5" style="clear: both">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-5 pb-5">

                <form action="{{route('pernikahan.update',$pernikahan->id)}}" method="post">
                    @method('PUT')
                    @csrf

                    <fieldset class="border-solid border-blue-500 border-2 p-4 my-8">
                        <legend class="px-2 text-lg">Data Keluarga:</legend>
                        <label class="block text-black mt-3 font-bold">Nama Kepala Keluarga</label>
                        <input type="text" value="{{$keluarga->kepala_keluarga}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>

                        <label for="alamat_rumah" class="block text-black mt-3 font-bold">Alamat Rumah</label>
                        <input type="text" value="{{$keluarga->alamat_rumah}}" class="rounded-md px-4 py-2 focus:outline-none bg-gray-300 lg:w-1/2 sm:w-full cursor-not-allowed mt-3" disabled readonly="readonly"/>
                    </fieldset>

                    <fieldset class="border-solid border-blue-500 border-2 p-4 my-8">
                        <legend class="px-2 text-lg">Data Mempelai:</legend>

                        <label for="mempelai" class="block text-black font-bold  mr-2">Nama Mempelai</label>
                        <select name="mempelai" class="w-1020 h-10  placeholder-gray-600 bg-gray-100 border rounded-md appearance-none focus:shadow-outline" placeholder="Golongan darah">
                          <option value="" disabled selected>Pilih nama mempelai</option>
                          @foreach ($detailKeluargas as $detailKeluarga)
                            @if ($detailKeluarga->hubungan == 'Anak')
                                <option @if (old('mempelai', $pernikahan->mempelai) == $detailKeluarga->jemaat_id) {{"selected"}}@endif value="{{$detailKeluarga->jemaat_id}}" >{{$detailKeluarga->nama}}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('mempelai')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="pasangan_mempelai_sugestion" class="block text-black mt-3 font-bold">Nama Pasangan Mempelai</label>
                        <input type="text" name="pasangan_mempelai_sugestion" id="pasangan_mempelai_sugestion" value="{{old('pasangan_mempelai_sugestion',$pernikahan->nama_pasangan_mempelai  ?? '')}}" placeholder="Arif Chandra Simanjuntak" class="rounded-md px-4 py-2 focus:outline-none bg-gray-100 lg:w-1/2 sm:w-full"/>
                        <div class="row z-10" id="match-list"></div>
                        @error('pasangan_mempelai_sugestion')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <input name="pasangan_mempelai" id="pasangan_mempelai" type="hidden" value="{{$pernikahan->pasangan_mempelai ?? ''}}">
                        @error('pasangan_mempelai')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                        <label for="tanggal_pemberkatan" class="block text-black mt-3 font-bold">Tanggal Pemberkatan Pernikahan</label>
                        <input type="text" name="tanggal_pemberkatan" id="tanggal-pemberkatan" value="{{old('tanggal_pemberkatan', $pernikahan->tanggal_pemberkatan ? date("d-m-Y",strToTime($pernikahan->tanggal_pemberkatan)) : '')}}" class="bg-gray-100 rounded-md" autocomplete="off" placeholder="dd-mm-yyyy"/>
                        @error('tanggal_pemberkatan')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror

                    </fieldset>

                    <div class="grid grid-cols-2 gap-4 my-8">
                        <fieldset class="border-solid border-blue-500 border-2 p-4 rounded-md">
                            <legend class="px-2 text-lg">Ucapan Syukur dari Paranak:</legend>

                            <label for="tk_akte_nikah_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Akte Nikah:</label>
                            <input type="text" name="tk_akte_nikah_paranak" value="{{old('tk_akte_nikah_paranak',$ucapanSyukur['paranak']['akte_nikah'])  ?? ''}}" placeholder="Ucapan Syukur Untuk Akte Nikah (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_akte_nikah_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_gereja_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Gereja:</label>
                            <input type="text" name="tk_gereja_paranak" value="{{old('tk_gereja_paranak',$ucapanSyukur['paranak']['gereja']  ?? '')}}" placeholder="Ucapan Syukur Untuk Gereja (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_gereja_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_majelis_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Majelis:</label>
                            <input type="text" name="tk_majelis_paranak" value="{{old('tk_majelis_paranak',$ucapanSyukur['paranak']['majelis']  ?? '')}}" placeholder="Ucapan Syukur Untuk Majelis (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_majelis_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_pendeta_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Pendeta:</label>
                            <input type="text" name="tk_pendeta_paranak" value="{{old('tk_pendeta_paranak',$ucapanSyukur['paranak']['pendeta']  ?? '')}}" placeholder="Ucapan Syukur Untuk Pendeta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_pendeta_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_guru_huria_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Guru Huria:</label>
                            <input type="text" name="tk_guru_huria_paranak" value="{{old('tk_guru_huria_paranak',$ucapanSyukur['paranak']['guru_huria']  ?? '')}}" placeholder="Ucapan Syukur Untuk Guru Huria (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_guru_huria_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_sintua_sektor_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Sintua Sektor:</label>
                            <input type="text" name="tk_sintua_sektor_paranak" value="{{old('tk_sintua_sektor_paranak',$ucapanSyukur['paranak']['sintua_sektor']  ?? '')}}" placeholder="Ucapan Syukur Untuk Sintua Sektor (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_sintua_sektor_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_lain_lain_paranak" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Lainya:</label>
                            <input type="text" name="tk_lain_lain_paranak" value="{{old('tk_lain_lain_paranak',$ucapanSyukur['paranak']['lain_lain']  ?? '')}}" placeholder="Ucapan Syukur Untuk pengembangan (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_lain_lain_paranak')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                        </fieldset>
                        <fieldset class="border-solid border-blue-500 border-2 p-4 rounded-md">
                            <legend class="px-2 text-lg">Ucapan Syukur dari paboru:</legend>

                            <label for="tk_akte_nikah_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Akte Nikah:</label>
                            <input type="text" name="tk_akte_nikah_paboru" value="{{old('tk_akte_nikah_paboru',$ucapanSyukur['paboru']['akte_nikah']  ?? '')}}" placeholder="Ucapan Syukur Untuk Akte Nikah (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_akte_nikah_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
 
                            <label for="tk_gereja_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Gereja:</label>
                            <input type="text" name="tk_gereja_paboru" value="{{old('tk_gereja_paboru',$ucapanSyukur['paboru']['gereja']  ?? '')}}" placeholder="Ucapan Syukur Untuk Gereja (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_gereja_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_majelis_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Majelis:</label>
                            <input type="text" name="tk_majelis_paboru" value="{{old('tk_majelis_paboru',$ucapanSyukur['paboru']['majelis']  ?? '')}}" placeholder="Ucapan Syukur Untuk Majelis (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_majelis_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_pendeta_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Pendeta:</label>
                            <input type="text" name="tk_pendeta_paboru" value="{{old('tk_pendeta_paboru',$ucapanSyukur['paboru']['pendeta']  ?? '')}}" placeholder="Ucapan Syukur Untuk Pendeta (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_pendeta_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_guru_huria_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Guru Huria:</label>
                            <input type="text" name="tk_guru_huria_paboru" value="{{old('tk_guru_huria_paboru',$ucapanSyukur['paboru']['guru_huria']  ?? '')}}" placeholder="Ucapan Syukur Untuk Guru Huria (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_guru_huria_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_sintua_sektor_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Sintua Sektor:</label>
                            <input type="text" name="tk_sintua_sektor_paboru" value="{{old('tk_sintua_sektor_paboru',$ucapanSyukur['paboru']['sintua_sektor']  ?? '')}}" placeholder="Ucapan Syukur Untuk Sintua Sektor (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_sintua_sektor_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                            <label for="tk_lain_lain_paboru" class="block text-black mt-3 font-bold">Ucapan Syukur Untuk Lainya:</label>
                            <input type="text" name="tk_lain_lain_paboru" value="{{old('tk_lain_lain_paboru',$ucapanSyukur['paboru']['lain_lain']  ?? '')}}" placeholder="Ucapan Syukur Untuk pengembangan (numerik tanpa tanda)" class="rounded-md px-4 py-2  focus:outline-none bg-gray-100 sm:w-full"/>
                            @error('tk_lain_lain_paboru')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </fieldset>
                    </div>
                    

                    <div class="clear-both px-5 pb-5"></div>
                    <button type="submit" class='relative bg-blue-500 text-white border border-blue-500 p-1 px-3 m-1 rounded overflow-hidden'>
                        <span class="material-icons">
                            save
                        </span>
                        Simpan perubahan
                    </button>
                
                    <x-back-button :link="url('/pernikahan')" />
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const picker = new Pikaday({
        field: document.getElementById('tanggal-pemberkatan'),
        yearRange: [1900, 2100],
        format: 'DD-MM-YYYY',
    })

    const matchList = document.getElementById("match-list");
    const searchInput = document.getElementById("pasangan_mempelai_sugestion");
    const pasanganMempelaiId = document.getElementById("pasangan_mempelai");

    const url = window.location.origin + '/api/jemaat/'
    searchInput.oninput = async ()=> getJemaat(searchInput);

    const setSearchValue = (jemaatNama, jemaatId) => {
        searchInput.value = jemaatNama;
        pasanganMempelaiId.value = jemaatId;
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

    async function getJemaat(x){
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
</script>

