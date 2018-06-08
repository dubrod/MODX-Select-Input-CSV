# MODX Select Inputs from CSV
Your typical automotive Year / Make / Model Input from a CSV
You can deep link (autofill) a form with URL params "quote&year=2019&make=Jeep&model=Wrangler"
No AJAX requests just a quick refresh of the page with pure JS. 

Page HTML

```
[[!CSVselect]]

<div id="autoSelects">
    <div>Year: [[+csv.year]]</div>
    <div>Make: [[+csv.make]]</div>
    <div>Model: [[+csv.model]]</div>
</div>

<script>
    
    var yearEl = document.getElementById('vehicleYear');
    var makeEl = document.getElementById('vehicleMake');
    
    function makeUrlParams(){
        var currentUrl = window.location;
        var baseUrl = currentUrl.pathname.split('&year')[0];

        if(yearEl.value.length > 1){
            var newUrl = baseUrl+"&year="+yearEl.value;
        
            if(makeEl.value.length > 1){
                newUrl = newUrl+"&make="+makeEl.value;
            }    
        }
        if(newUrl.length){
            window.location = newUrl;
        }    
    }
    
    
    yearEl.addEventListener("change", makeUrlParams, false);
    makeEl.addEventListener("change", makeUrlParams, false);
    
</script>
```
