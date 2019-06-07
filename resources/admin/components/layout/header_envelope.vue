<template>
	<li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" v-on:click="getLastNewMessages()">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success" v-if="unreadNum">{{ unreadNum }}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">你有{{ unreadNum }}条未读信息</li>
          <template v-if="loading">
          		<li class="text-center">
          			<i class="fa fa-refresh fa-spin"></i>
          		</li>
          </template>
          <template v-else>
          		<template v-if="!messages.length">
          			<li class="text-center">
	          			暂时没有未读消息
	          		</li>
          		</template>
          		<template v-else>
	          		<li>
	          			<ul class="menu">
			              <li v-for="m in messages"><!-- start message -->
			                <a href="javascript:void(0)" v-on:click="$router.push({path: '/personal_messages',query:{contacts_id: m.sender_id}})">
			                  <div class="pull-left">
			                    <img :src="m.avatar" class="img-circle" alt="User Image">
			                  </div>
			                  <h4>
			                  	{{ m.name }}
			                    <small><i class="fa fa-clock-o"></i>{{ FDateToNow(m.created_at) }}</small>
			                  </h4>
			                  <p>{{ m.content }}</p>
			                </a>
			              </li>
	          			</ul>
	          		</li>
          		</template>
          </template>
          <li class="footer"><a href="javascript:void(0)" v-on:click="$router.push({path: '/personal_messages'})">查看所有信息</a></li>
        </ul>
      </li>
</template>
<script>
export default{
	name: 'header-envelope',
	data () {
		return {
			unreadNum: 0,
			messages: [],
			loading: false,
			timer: null
		}
	},
	created () {
		var _this = this
		_this.getUnreadNum();
		_this.timer =setInterval(()=>{
			_this.getUnreadNum()
		}, 10000);
	},
	destroyed () {
		clearInterval(this.timer);
	},
	methods: {
		getUnreadNum () {
			var _this = this;
    		_this.ajax({
    			url: '/admin/messages/personal/unreadNum',
    			type: 'GET',
    			dataType: 'json',
    			success (json) {
    				_this.unreadNum = json.unreadNum;
    			}
    		});
		},
		getLastNewMessages () {
			var _this = this;
    		_this.ajax({
    			url: '/admin/messages/personal/lastNewMessages',
    			type: 'GET',
    			dataType: 'json',
    			beforeSend () {
    				_this.loading = true;
    			},
    			success (json) {
    				_this.messages = json;
    			},
    			complete () {
    				_this.loading = false;
    			}
    		});
		}
	}
}
</script>