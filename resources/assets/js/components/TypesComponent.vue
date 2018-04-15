<script>
    export default {
        name: 'type-component',
        props: ['typesList'],
        template:
            '<select name="type" id="type" class="form-control" v-model="this.selectedtype">' +
            '   <option value="php" selected>PHP</option>\n' +
            '   <option value="javascript">Javascript</option>\n' +
            '   <option value="jquery">jQuery</option>\n' +
            '   <option value="html">HTML</option>\n' +
            '   <option value="css">CSS</option>\n' +
            '   <option value="sql">SQL</option>\n' +
            '   <option value="json">JSON</option>\n' +
            '   <option value="xml">XML</option>\n' +
            '   <option value="infusionsoft">Infusionsoft</option>\n' +
            '   <option value="wordpress">WordPress</option></select>',
        data: function () {
            return {
                selectedtype: this.typesList,
            };
        }
    }
</script>
