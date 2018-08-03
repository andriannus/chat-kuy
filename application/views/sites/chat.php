<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="chat">
	<section class="hero is-white is-fullheight">
		<div class="hero-body">
			<div class="container">
				<div class="columns">
					<div class="column is-6 is-offset-3">
						<div class="has-text-centered">
							<p class="title">Ruang Chat</p>
						</div>

						<hr>

						<div class="chat-box" style="margin-bottom: 20px;">
							<article class="message mb-5" v-for="(message, index) in messages">
								<div class="message-body">
									<nav class="level is-mobile">
										<div class="level-left">
											<div class="level-item">
												<p>
													<strong>{{ message.username }}</strong>
												</p>
											</div>
										</div>

										<div class="level-right">
											<div class="level-item">
												<p>
													<small>{{ message.timestamp | current }}</small>
												</p>
											</div>
										</div>
									</nav>
									
									<p>
										{{ message.message }}
									</p>
								</div>
							</article>
						</div>

						<p class="has-text-grey-light mb-5" :style="{ visibility: isTyping }">
							<i class="fas fa-sync fa-spin"></i>
							Someone is typing...
						</p>

						<div class="field has-addons" v-if="!loading">
							<div class="control is-expanded">
								<input
									class="input"
									type="text"
									placeholder="Ketik pesan.."
									v-model="message"
									@input="typing"
									@keyup.enter="sendMessage"
								></input>
							</div>

							<div class="control">
								<button class="button is-link" @click="sendMessage">
									<span class="icon is-small">
										<i class="fas fa-paper-plane"></i>
									</span>
								</button>
							</div>
						</div>

						<div class="field" v-if="loading">
							<div class="control is-loading">
								<input type="text" class="input" placeholder="Mengirim pesan..." readonly>
							</div>
						</div>

						<div class="has-text-centered">
							<a href="<?= base_url('site/logout') ?>" class="button is-danger">Log out</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
const chat = new Vue({
	el: '#chat',
	data: () => ({
		pusher: '',
		channel: '',
		messages: [],
		message: '',
		debounce: '',
		isTyping: 'hidden',
		currentUser: '<?= $this->session->username ?>',
		loading: false
	}),

	mounted() {
		this.config()
	},

	methods: {
		config () {
			this.pusher = new Pusher('xx', {
				cluster: 'ap1',
				encrypted: true
			})

			this.channel = this.pusher.subscribe('chat-kuy')

			this.channel.bind('chat', function (data) {
				chat.messages.push(data)
				console.log(chat.messages)
			})

			this.channel.bind('typing', function (data) {
				if (chat.currentUser !== data.username) {
					chat.isTyping = 'visible'
				}

				chat.debounce()
			})

			this.debounce = _.debounce(function() {
				this.isTyping = 'hidden'
			}, 1000)
		},

		typing () {
			axios.get('<?= base_url() ?>' + 'site/someoneIsTyping')
				.then(res => {
					//
				})
				.catch(err => {
					//
				})
		},

		sendMessage () {
			this.loading = true

			let data = 'message=' + this.message

			axios.post('<?= base_url() ?>' + 'site/sendChat', data)
				.then(res => {
					if (res.data.success) {
						this.message = ''
						this.loading = false
						this.scrollToBottom()
					}
				})
				.catch(err => {
					//
				})
		},

		scrollToBottom () {
			let chatBox = this.$el.querySelector('.chat-box')
			chatBox.scrollTop = chatBox.scrollHeight
		}
	},

	filters: {
		current: (timestamp) => moment(timestamp).format('MMMM Do YYYY, h:mm:ss a')
	}
})
</script>
