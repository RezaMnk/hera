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

    update_map.on('click', async function(e) {
        if (marker)
            update_map.removeLayer(marker);

        document.getElementById('update-address').value = await search_address(e.latlng.lat, e.latlng.lng);
        document.getElementById('update-lat').value = e.latlng.lat;
        document.getElementById('update-long').value = e.latlng.lng;
        marker = L.marker(e.latlng, {icon: icon}).addTo(update_map);
    });

    setTimeout(function () {
        window.dispatchEvent(new Event("resize"));
    }, 500);
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

    add_map.on('click', async function(e) {
        if (marker)
            add_map.removeLayer(marker);

        document.getElementById('add-address').value = await search_address(e.latlng.lat, e.latlng.lng);
        document.getElementById('add-lat').value = e.latlng.lat;
        document.getElementById('add-long').value = e.latlng.lng;
        marker = L.marker(e.latlng, {icon: icon}).addTo(add_map);
    });

    setTimeout(function () {
        window.dispatchEvent(new Event("resize"));
    }, 500);
}
