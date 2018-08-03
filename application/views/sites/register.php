<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="hero is-white is-fullheight" v-if="!areaFound">
	<div class="hero-body">
		<div class="container">
			<div class="columns">
				<div class="column is-4 is-offset-4">
					<div class="has-text-centered">
						<p class="title">Daftar</p>
						<p class="subtitle">Digunakan sebagai tanda pengenal</p>
					</div>
					<hr>
					<?= form_open('site/registerProcess') ?>
						<div class="field">
							<label class="label">Nama</label>
							<div class="control has-icons-left">
								<input
									class="input"
									type="text"
									placeholder="Nama atau Inisial"
									name="username"
									required
									pattern="[A-Za-z]{3,}"
									title="Alphabet and at least 3 characters">
								<span class="icon is-small is-left">
									<i class="fas fa-user"></i>
								</span>
							</div>
						</div>

						<div class="field">
							<button class="button is-link is-fullwidth">
								<span>Berikutnya</span>
								<span class="icon is-small">
									<i class="fas fa-arrow-right"></i>
								</span>
							</button>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</section>
