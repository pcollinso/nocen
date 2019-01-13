<template>
  <!-- menu with submenu -->
  <li v-if="menu.children" class="has-sub" v-bind:class="{ 'active': subIsActive(menu.path) }">
    <a href="#" v-on:click.prevent.stop="expand()">
      <span v-if="menu.badge" class="badge pull-right">{{ menu.badge }}</span>
      <b v-else class="caret"></b>
      <i v-if="menu.icon" v-bind:class="menu.icon"></i>
      <div v-if="menu.img" class="icon-img">
        <img v-bind:src="menu.img" alt>
      </div>
      <span>{{ menu.title }}</span>
      <i v-if="menu.highlight" class="fa fa-paper-plane text-theme m-l-5"></i>
      <span v-if="menu.label" class="label label-theme m-l-5">{{ menu.label }}</span>
    </a>
    <ul
      class="sub-menu"
      v-bind:class="{ 'd-block': this.stat == 'expand', 'd-none': this.stat == 'collapse' }"
      v-bind:style="{ marginTop: (pageOptions.pageSidebarMinified) ? - (scrollTop + 40) + 'px' : '' }"
    >
      <sidebar-nav-list
        v-for="(submenu, i) in menu.children"
        :menu="submenu"
        :key="i"
        ref="sidebarNavList"
        v-on:collapse-other="handleCollapseOther(submenu)"
      ></sidebar-nav-list>
    </ul>
  </li>

  <!-- menu without submenu -->
  <li v-else :class="{ 'active': subIsActive(menu.path) }">
    <a :href="menu.path">
      <span v-if="menu.badge" class="badge pull-right">{{ menu.badge }}</span>
      <i v-if="menu.icon" v-bind:class="menu.icon"></i>
      <div v-if="menu.img" class="icon-img">
        <img v-bind:src="menu.img" alt>
      </div>
      <span>{{ menu.title }}</span>
      <i v-if="menu.highlight" class="fa fa-paper-plane text-theme m-l-5"></i>
      <span v-if="menu.label" class="label label-theme m-l-5">{{ menu.label }}</span>
    </a>
  </li>
</template>

<script>
import SidebarNavList from './SidebarNavList.vue';
import PageOptions from '../PageOptions.vue';

export default {
	name: 'SidebarNavList',
	props: ['menu', 'scrollTop'],
	components: {
		SidebarNavList
	},
	data() {
		return {
			stat: '',
			pageOptions: PageOptions
		}
	},
	methods: {
		expand: function() {
			if (this.stat == '') {
				this.stat = (this.subIsActive(this.menu.path)) ? 'collapse' : 'expand';
			} else {
				this.stat = (this.stat == 'expand') ? 'collapse' : 'expand'
			}
			this.$emit('collapse-other', this.menu)
		},
		collapse: function(menu) {
			if (this.menu != menu) {
				this.stat = 'collapse'
			}
		},
		collapseOther: function() {
			this.$emit('collapse-other', this.menu)
		},
		handleCollapseOther: function(menu) {
			for (var i = 0; i < this.menu.children.length; i++) {
				this.$refs.sidebarNavList[i].collapse(menu);
			}
		},
		subIsActive(path) {
      const { location: { pathname } } = window;
      return pathname.indexOf(path) === 0;
		}
  }
}
</script>
