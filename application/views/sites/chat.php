<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="hero is-white is-fullheight" v-if="!areaFound">
	<div class="hero-body">
		<div class="container">
			<div class="columns">
				<div class="column is-6 is-offset-3">
					<div class="has-text-centered">
						<p class="title">Ruang Chat</p>
					</div>
					<hr>
					<div class="box chat-box">

					</div>
					<div class="field has-addons">
						<div class="control is-expanded">
							<input class="input" type="text" placeholder="Ketik pesan.." v-model="name"></input>
						</div>

						<div class="control">
							<button class="button is-link">
								<span class="icon is-small">
									<i class="fas fa-paper-plane"></i>
								</span>
							</button>
						</div>
					</div>

					<div class="has-text-centered">
						<button class="button is-danger">Log out</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
