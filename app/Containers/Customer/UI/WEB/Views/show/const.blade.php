<div class="tab-pane" id="const">
    <div class="card" v-for="item in listPrices">
        <div class="card-header">
            <h3 v-text="item.title"></h3>
        </div>
        <div class="card-body">
            <div class="form-check" v-for="price in item.consts">
                <input class="form-check-input" :checked="user.prices[item.id].constID == price.id" type="radio" :name="item.id" :id="price.id" @click="setPrices(price)">
                <label class="form-check-label" :for="price.id" v-text="price.title"></label>
            </div>
        </div>
    </div>
</div>
