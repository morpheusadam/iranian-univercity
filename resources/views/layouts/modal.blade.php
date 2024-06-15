@section('modal-script')
    <script>
        const Modal = document.getElementById('Modal')
        if (Modal) {
            Modal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget

                const action = button.getAttribute('data-bs-action')
                const name = button.getAttribute('data-bs-name')

                const modalForm = Modal.querySelector('.modal-form')
                const modalTitle = Modal.querySelector('.modal-title')
                // const modalBody = Modal.querySelector('.modal-body')

                modalForm.action = action
                modalTitle.textContent = `حذف ${name}`
                // modalBody.textContent = name
            })
        }
    </script>
@endsection

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-danger" id="ModalLabel" style="font-family: Shabnam, Vazir"></h1>
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                آیا از انجام این عملیات مطمئن هستید؟ <br>
                @if (!in_route('terms.index'))
                    (با اینکار تمام کلاس های مربوطه نیز حذف میشوند.)
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="event.preventDefault();Modal.querySelector('.modal-form').submit();">حذف</button>
                <form class="d-none modal-form" action="" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit"></button>
                </form>
            </div>
        </div>
    </div>
</div>
