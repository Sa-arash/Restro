<?php

use Livewire\Volt\Component;
use App\Models\Contact;
new class extends Component {
    
    public $name;
    public $phone;
    public $comment;
    public $captcha;

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required|numeric',
        'comment' => 'required|min:10',
        'captcha' => 'required|captcha',
    ];

    public function submit()
    {
        $this->validate();

        Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'comment' => $this->comment,
        ]);

        session()->flash('comment', 'پیام شما با موفقیت ارسال شد!');
        return redirect()->route('home');
    }

    // public function render()
    // {
    //     return view('livewire.page.contact');
    // }

}; ?>
<div>
    <main>
        <div class="box-main">
            <div class="box-right-main">
                <div class="background-box">
                    <p>رستوران سماط</p>
                </div>
            </div>
            <div class="box-left-main">
                <form wire:submit.prevent="submit" class="form">
                    <p>تماس با ما</p>

                    @if (session()->has('comment'))
                        <div class="alert alert-success">
                            {{ session('comment') }}
                        </div>
                    @endif

                    <input
                        type="text"
                        class="input-contact"
                        placeholder="نام و نام خانوادگی خود را وارد کنید"
                        wire:model="name"
                    />
                    @error('name') <span class="error">{{ $message }}</span> @enderror

                    <input
                        type="text"
                        class="input-contact"
                        placeholder="شماره تماس خود را وارد کنید"
                        wire:model="phone"
                    />
                    @error('phone') <span class="error">{{ $message }}</span> @enderror

                    <textarea
                        rows="4"
                        cols="50"
                        class="textarea-contact"
                        placeholder="پیام خود را وارد کنید"
                        wire:model="comment"
                    ></textarea>
                    @error('comment') <span class="error">{{ $message }}</span> @enderror

                    <div>
                        <label for="captcha">کد امنیتی:</label>
                        {!! captcha_img() !!}
                        <input type="text"  class="input-contact" id="captcha" wire:model="captcha" required>
                        @error('captcha') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn-send-request">ارسال</button>
                </form>
            </div>
        </div>
    </main>
</div>