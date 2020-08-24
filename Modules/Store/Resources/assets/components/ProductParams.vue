<template>
    <div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label text-right">Product params</label>
            <div class="col-lg-6">
                <div class="row m-b-10">
                    <div class="col-lg-4">
                        <input type="text"
                               name="productVariant[label]"
                               id="productvariantlabel"
                               class="form-control no-radius ">
                    </div>
                    <div class="col-lg-8">
                        <link rel="stylesheet" href="/modules/plugins/tag-it/css/jquery.tagit.css">
                        <ul id="jquery-tagIt"
                            data-name="productVariant[params]"
                            class="inverse tagit ui-widget ui-widget-content ui-corner-all"></ul>
                    </div><!-- End ./col-lg-8 -->
                </div><!-- End ./row -->
            </div><!-- End ./col-lg-6 -->
        </div><!-- End ./form-group -->
    </div>
</template>

<script>
    export default {
        name: "productparams"
    }
</script>

<style scoped>

</style>
