<x-layout title="Novo usuário">
    <form action="" method="POST" class="mt-2">
        @csrf
        <div class="form-group">

            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" id="name" class="form-control">

            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control">

            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" id="password" class="form-control">

            <label for="password_confirmation" class="form-label">Confirmação de senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">


        </div>

        <button class="btn btn-primary mt-3">Registrar</button>


    </form>
</x-layout>
