@if($action == 'edit' || $action == 'add')
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
@forelse($dataTypeContent->getCoordinates() as $point)
    <input type="hidden" name="{{ $row->field }}[lat]" value="{{ $point['lat'] }}" id="lat"/>
    <input type="hidden" name="{{ $row->field }}[lng]" value="{{ $point['lng'] }}" id="lng"/>
@empty
    <input type="hidden" name="{{ $row->field }}[lat]" value="{{ config('voyager.googlemaps.center.lat') }}" id="lat"/>
    <input type="hidden" name="{{ $row->field }}[lng]" value="{{ config('voyager.googlemaps.center.lng') }}" id="lng"/>
@endforelse

<script type="application/javascript">
    function initMap() {
                @forelse($dataTypeContent->getCoordinates() as $point)
        var center = {lat: {{ $point['lat'] }}, lng: {{ $point['lng'] }}};
                @empty
        var center = {lat: {{ config('voyager.googlemaps.center.lat') }}, lng: {{ config('voyager.googlemaps.center.lng') }}};
                @endforelse
        var map = new google.maps.Map(document.getElementById('map'), {
                zoom: {{ config('voyager.googlemaps.zoom') }},
                center: center
            });
        var markers = [];
                @forelse($dataTypeContent->getCoordinates() as $point)
        var marker = new google.maps.Marker({
                position: {lat: {{ $point['lat'] }}, lng: {{ $point['lng'] }}},
                map: map,
                draggable: true
            });
        markers.push(marker);
                @empty
        var marker = new google.maps.Marker({
                position: center,
                map: map,
                draggable: true
            });
        @endforelse
        //make search-box
        var searchBox = new google.maps.places.SearchBox(document.getElementById('searchMap'));

        //change marker position, base on selection list box item
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for (i = 0; place = places[i]; i++) {
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location);
            }
            map.fitBounds(bounds);
            map.setZoom({{ config('voyager.googlemaps.zoom') }});
        });
        google.maps.event.addListener(marker,'dragend',function(event) {
            document.getElementById('lat').value = this.position.lat();
            document.getElementById('lng').value = this.position.lng();
        });
    }
</script>
<div>
    <label for="searchMap" >Search Location </label>
    <input type="text" id="searchMap" class="form-control">
    <div id="map"></div>
</div>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('voyager.googlemaps.key') }}&callback=initMap"></script>
@elseif($action == 'browse')
    @include('voyager::partials.coordinates-static-image')
@elseif($action== 'read')
    @include('voyager::partials.coordinates')
@endif
