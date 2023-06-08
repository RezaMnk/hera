let update_map;
let add_map;
let marker;
let icon;

const ghoreishi_border = [
    [
        35.75991019932242,
        51.25506346411922
    ],
    [
        35.75366132971044,
        51.275246140270156
    ],
    [
        35.75289558909279,
        51.31629118337827
    ],
    [
        35.74906677548405,
        51.366300086475434
    ],
    [
        35.751874590141156,
        51.41583720746897
    ],
    [
        35.74881144973506,
        51.42291408108528
    ],
    [
        35.750853513133066,
        51.44508784000621
    ],
    [
        35.75621368026563,
        51.456882392623726
    ],
    [
        35.75621368026563,
        51.46663255612117
    ],
    [
        35.759404084521336,
        51.47999971575365
    ],
    [
        35.75787270644389,
        51.5094074669465
    ],
    [
        35.74740750075627,
        51.566807623017866
    ],
    [
        35.81163348990809,
        51.53388282861201
    ],
    [
        35.81823141368652,
        51.42938054890061
    ],
    [
        35.78547464189957,
        51.31087504571988
    ],
    [
        35.75991019932242,
        51.25506346411922
    ]
]

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

    let polygon = L.polygon(ghoreishi_border, {color: 'green'}).addTo(update_map);
    // update_map.fitBounds(polygon.getBounds());

    marker = L.marker([lat, long], {icon: icon}).addTo(update_map);

    update_map.on('click', async function(e) {

        let new_marker = L.marker(e.latlng, {icon: icon})

        if (! polygon.contains(new_marker.getLatLng()))
        {
            return Toastify({
                text: "آدرس مورد نظر خارج از محدوده است",
                position: "left",
                className: "toastify-danger",
                offset: {
                    x: '2rem',
                    y: '2rem'
                }
            }).showToast();
        }

        document.getElementById('update-map-loading').classList.add('d-none');

        if (marker)
            update_map.removeLayer(marker);

        document.getElementById('update-address').value = await search_address(e.latlng.lat, e.latlng.lng);
        document.getElementById('update-lat').value = e.latlng.lat;
        document.getElementById('update-long').value = e.latlng.lng;
        marker = new_marker.addTo(update_map);

        document.getElementById('update-map-loading').classList.add('d-none');
    });

    setTimeout(function () {
        window.dispatchEvent(new Event("resize"));
    }, 1000);

}

function add_load_map(lat, long)
{
    add_map = new L.Map('add-map', {
        key: 'web.a26d783d73c94bec9900322ce1a88f99',
        maptype: 'dreamy',
        poi: true,
        traffic: false,
        center: [lat, long],
        zoom: 14,
    });

    let polygon = L.polygon(ghoreishi_border, {color: 'green'}).addTo(add_map);
    // add_map.fitBounds(polygon.getBounds());

    marker = L.marker([lat, long], {icon: icon}).addTo(add_map);

    add_map.on('click', async function(e) {

        let new_marker = L.marker(e.latlng, {icon: icon})

        if (! polygon.contains(new_marker.getLatLng()))
        {
            return Toastify({
                text: "آدرس مورد نظر خارج از محدوده است",
                position: "left",
                className: "toastify-danger",
                offset: {
                    x: '2rem',
                    y: '2rem'
                }
            }).showToast();
        }

        document.getElementById('add-map-loading').classList.remove('d-none');

        if (marker)
            add_map.removeLayer(marker);

        document.getElementById('add-address').value = await search_address(e.latlng.lat, e.latlng.lng);
        document.getElementById('add-lat').value = e.latlng.lat;
        document.getElementById('add-long').value = e.latlng.lng;
        marker = new_marker.addTo(add_map);

        document.getElementById('add-map-loading').classList.add('d-none');
    });

    setTimeout(function () {
        window.dispatchEvent(new Event("resize"));
    }, 1000);
}

function isMarkerInsidePolygon(marker, poly) {
    let polyPoints = poly.getLatLngs();
    let x = marker.getLatLng().lat, y = marker.getLatLng().lng;

    let inside = false;
    for (let i = 0, j = polyPoints.length - 1; i < polyPoints.length; j = i++) {
        let xi = polyPoints[i].lat, yi = polyPoints[i].lng;
        let xj = polyPoints[j].lat, yj = polyPoints[j].lng;

        let intersect = ((yi > y) != (yj > y))
            && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
        if (intersect) inside = !inside;
    }

    return inside;
};
