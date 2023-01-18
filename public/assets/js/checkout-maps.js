let update_map;
let add_map;
let marker;
let icon;

function update_load_map(lat, long)
{
    update_map = new L.Map('update-map', {
        key: 'web.a26d783d73c94bec9900322ce1a88f99',
        maptype: 'dreamy',
        poi: true,
        traffic: false,
        center: [lat, long],
        zoom: 17,
    });
    marker = L.marker([lat, long], {icon: icon}).addTo(update_map);

    update_map.on('click', function(e) {
        if(marker)
            update_map.removeLayer(marker);

        document.getElementById('update-lat').value = e.latlng.lat;
        document.getElementById('update-long').value = e.latlng.lng;
        marker = L.marker(e.latlng, {icon: icon}).addTo(update_map);
    });
}

function add_load_map(lat, long)
{
    add_map = new L.Map('add-map', {
        key: 'web.a26d783d73c94bec9900322ce1a88f99',
        maptype: 'dreamy',
        poi: true,
        traffic: false,
        center: [lat, long],
        zoom: 17,
    });
    marker = L.marker([lat, long], {icon: icon}).addTo(add_map);

    add_map.on('click', function(e) {
        if(marker)
            add_map.removeLayer(marker);

        document.getElementById('add-lat').value = e.latlng.lat;
        document.getElementById('add-long').value = e.latlng.lng;
        marker = L.marker(e.latlng, {icon: icon}).addTo(add_map);
    });
}

function update_modal_update_map(lat, long)
{
    document.querySelector('#update-lat').value = lat;
    document.querySelector('#update-long').value = long;

    update_map.setView(new L.LatLng(lat, long), 17);
    update_map.removeLayer(marker);
    marker = L.marker([lat, long], {icon: icon}).addTo(update_map);


    let map_loading = document.querySelector('.update-map-loading');

    map_loading.style.opacity = '0';
    map_loading.classList.toggle('d-none')
}

function add_modal_update_map(lat, long)
{
    document.querySelector('#add-lat').value = lat;
    document.querySelector('#add-long').value = long;

    add_map.setView(new L.LatLng(lat, long), 17);
    add_map.removeLayer(marker);
    marker = L.marker([lat, long], {icon: icon}).addTo(add_map);


    let map_loading = document.querySelector('.add-map-loading');

    map_loading.style.opacity = '0';
    map_loading.classList.toggle('d-none')
}

async function update_get_by_address()
{
    let map_loading = document.querySelector('.update-map-loading');

    map_loading.classList.toggle('d-none')
    map_loading.style.opacity = '1';

    let main_street = document.querySelector('#update-main_street').value;
    let side_street = document.querySelector('#update-side_street').value;
    let alley = document.querySelector('#update-alley').value;

    let address = main_street;

    if (side_street)
        address += '، خیابان ' + side_street

    if (alley)
        address += '، کوچه ' + alley

    let coordinates = await search_address(address)
    update_modal_update_map(coordinates.lat, coordinates.long)
}


async function add_get_by_address()
{
    let map_loading = document.querySelector('.add-map-loading');

    map_loading.classList.toggle('d-none')
    map_loading.style.opacity = '1';

    let main_street = document.querySelector('#add-main_street').value;
    let side_street = document.querySelector('#add-side_street').value;
    let alley = document.querySelector('#add-alley').value;

    let address = main_street;

    if (side_street)
        address += '، خیابان ' + side_street

    if (alley)
        address += '، کوچه ' + alley

    let coordinates = await search_address(address)
    add_modal_update_map(coordinates.lat, coordinates.long)
}
