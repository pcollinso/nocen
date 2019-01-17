<template>
  <Page>
    <breadcrumb/>
    <page-title title="Institutions" subtitle="...Active Institutions"/>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-inverse">
          <div class="panel-heading">
            <h4 class="panel-title">Institutions - Listing(...only active institutions show here)</h4>
          </div>
          <div class="panel-body">
            <button class="btn btn-sm btn-primary" @click.stop.prevent="view(null)">Add institution</button>
            <div class="table-responsive">
              <table class="table table-striped m-b-0">
                <thead>
                  <tr>
                    <th>Inst. Type</th>
                    <th>Logo</th>
                    <th>Inst. Code</th>
                    <th>Inst. name</th>
                    <th>Address</th>
                    <th>City/State</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Staff 2-Way Auth</th>
                    <th>Employee 2-Way Auth</th>
                    <th>Entered by</th>
                    <th>Created at</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="inst in localInstitutions" :key="inst.id">
                    <td>{{ inst.institution_type.institution_type }}</td>
                    <td>
                      <img height="50" width="50" :src="instLogoUrl(inst)" alt="institution logo">
                    </td>
                    <td>{{ inst.institution_code }}</td>
                    <td>{{ inst.institution_name }}</td>
                    <td>{{ inst.address }}</td>
                    <td>{{ inst.city }}/{{ inst.state }}</td>
                    <td>{{ inst.phone }}</td>
                    <td>{{ inst.email }}</td>
                    <td>{{ inst.staff_2wa == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ inst.employee_2wa == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ inst.entered_by }}</td>
                    <td>{{ inst.created_at }}</td>
                    <td class="with-btn" nowrap>
                      <button
                        @click.stop.prevent="view(inst)"
                        class="btn btn-sm btn-primary m-r-2"
                      >View/Edit</button>
                      <button
                        v-if="inst.active"
                        @click.stop.prevent="deactivate(inst)"
                        class="btn btn-sm btn-white"
                      >Deactivate</button>
                      <button
                        v-else
                        @click.stop.prevent="activate(inst)"
                        class="btn btn-sm btn-primary"
                      >Activate</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div ref="instModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ selectedTitle }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Institution type * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="institution.institution_type_id">
                      <option value="0">Select type</option>
                      <option
                        :value="t.id"
                        v-for="t in institutionTypes"
                        :key="t.id"
                      >{{ t.institution_type }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Institution name * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input
                      type="text"
                      class="form-control"
                      v-model.trim="institution.institution_name"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Institution code * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input
                      type="text"
                      class="form-control"
                      v-model.trim="institution.institution_code"
                    >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Address * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" v-model.trim="institution.address">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">State * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="state">
                      <option :value="{}">Select state</option>
                      <option :value="s" v-for="s in states" :key="s.id">{{ s.state }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">LGA * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="lga">
                      <option :value="{}">Select lga</option>
                      <option :value="l" v-for="l in filteredLgas" :key="l.id">{{ l.name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">City * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="institution.city">
                      <option :value="''">Select city</option>
                      <option :value="c.town" v-for="c in filteredTowns" :key="c.id">{{ c.town }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Phone :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="text" class="form-control" v-model.trim="institution.phone">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Email * :</label>
                  <div class="col-md-6 col-sm-6">
                    <input type="email" class="form-control" v-model.trim="institution.email">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Staff 2-way authentication * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="institution.staff_2wa">
                      <option value="0">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Employee 2-way authentication * :</label>
                  <div class="col-md-6 col-sm-6">
                    <select class="form-control" v-model="institution.employee_2wa">
                      <option value="0">NO</option>
                      <option value="1">YES</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4 col-sm-4">Logo(262 X 162) :
                    <br>Allowed extensions (jpeg, jpg, png) :
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <!-- Handle logo -->
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button @click.stop.prevent="save()" type="button" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Page>
</template>
<script>
import Page from './Page';
import PageTitle from '../components/header/PageTitle';
import Breadcrumb from '../components/header/Breadcrumb';

const defaultInstitution = {
  staff_2wa: 0,
  employee_2wa: 0,
  institution_code: '',
  institution_name: '',
  institution_type_id: 0,
  active: 1,
  email: '',
  phone: '',
  address: '',
  city: '',
  lga: '',
  state: '',

};

export default {
  name: 'Institutions',
  props: {
    institutions: {
      type: Array,
      required: true
    },
    institutionTypes: {
      type: Array,
      required: true
    },
    states: {
      type: Array,
      required: true
    },
    lgas: {
      type: Array,
      required: true
    },
    towns: {
      type: Array,
      required: true
    }
  },
  components: {
    Page,
    PageTitle,
    Breadcrumb
  },
  data() {
    return {
      localInstitutions: this.institutions,
      institution: {},
      selectedTitle: '',
      state: {},
      lga: {}
    };
  },
  computed: {
    filteredLgas() {
      const { state } = this;
      if (!state || !state.state) return this.lgas;
      return this.lgas.filter(({ state_id }) => state_id == state.id);
    },
    filteredTowns() {
      const { lga } = this;
      if (!lga || !lga.name) return this.towns;
      return this.towns.filter(({ lga_id }) => lga_id == lga.id);
    }
  },
  watch: {
    state(state) {
      if (state) this.institution.state = state.state;
    },
    lga(lga) {
      if (lga) this.institution.lga = lga.name;
    }
  },
  methods: {
    instLogoUrl(inst) {
      return inst.logo;
    },
    save() {
      const copy = { ...this.institution };
      copy.institution_name = copy.institution_name.toUpperCase();

      if (copy.id) {
        delete copy.institution_type;

        axios
        .put(`/s/institutions/${copy.id}`, copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('Institution updated');
            $(this.$refs.instModal).modal('hide');
            this.localInstitutions = this.localInstitutions.map((institution) => {
              if (data.id === institution.id) return data;
              return institution;
            });
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
      } else {
        axios
        .post('/s/institutions', copy)
        .then(({ data: { success, data, message = '' } }) => {
          if (success) {
            alert('Institution created');
            $(this.$refs.instModal).modal('hide');
            this.localInstitutions.push(data);
            this.institution = { ...defaultInstitution };
          } else {
            alert(message);
          }
        })
        .catch(({ response: { data } }) => console.log('error', data));
      }
    },
    view(inst) {
      if (inst) {
        this.selectedTitle = `Update ${inst.institution_name}`;
        this.state = this.states.find(({ state }) => state === inst.state) || {};
        this.lga = this.lgas.find(({ name }) => name === inst.lga) || {};
        this.institution = { ...inst };
      } else {
        this.selectedTitle = 'Create institution';
        this.state = {};
        this.lga = {};
        this.institution = { ...defaultInstitution };
      }
      $(this.$refs.instModal).modal('show');
    },
    deactivate(inst) {
      axios
      .put(`/s/institutions/${inst.id}`, { active: 0 })
      .then(({ data: { success, data } }) => {
        if (success) {
          alert('Institution deactivated');
          this.localInstitutions = this.localInstitutions.map((institution) => {
            if (data.id === institution.id) return data;
            return institution;
          });
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    },
    activate(inst) {
      axios
      .put(`/s/institutions/${inst.id}`, { active: 1 })
      .then(({ data: { success, data } }) => {
        if (success) {
          alert('Institution activated');
          this.localInstitutions = this.localInstitutions.map((institution) => {
            if (data.id === institution.id) return data;
            return institution;
          });
        }
      })
      .catch(({ response: { data } }) => console.log('error', data));
    }
  }
}
</script>
