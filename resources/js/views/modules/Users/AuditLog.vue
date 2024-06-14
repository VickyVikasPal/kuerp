<template>
    <div class="container-fluid">
        <div class="card mb-2 mt-2">
            <div class="card-header">
                <h3>{{lang.LBL_AUDIT_LOG}}</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped m-0 item_table">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Change Logs</th>
                                <th>Changed By</th>
                                <th>Change Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(audit, index) in audits">
                                <td>{{audit.event}}</td>
                                <td>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td>Field Name</td>
                                                <td>Old Value</td>
                                                <td>New Value</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(child) in audit.child_array">
                                                <td>{{child.field_name}}</td>
                                                <td>{{child.old_value}}</td>
                                                <td>{{child.new_value}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>{{audit.changed_by}}</td>
                                <td>{{audit.changed_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import lang from "@/views/modules/Users/language/en";
    export default {
        name: 'audit-log',
        data() {
            return {
                lang: [],
                audits: [{
                    child_array: [],
                }],
            }
        },
        mounted() {
            this.lang = lang;
            this.getChangeLogs();
        },
        methods: {
            getChangeLogs() {
                const self = this;
                self.record = self.$route.params.id;
                if (typeof (self.record) != 'undefined') {
                    self.showpassfiled = false;
                    let record_id = self.record;
                    axios.get('api/modules/users/change-logs/' + self.$route.params.id).then(function (response) {
                        self.audits = response.data;
                        console.log(response.data);
                        self.loading = false;
                    }).catch(function () {
                        self.loading = false;
                    });
                }
            }
        }
    }
</script>