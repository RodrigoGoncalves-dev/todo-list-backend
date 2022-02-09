<p>Olá {{$user->first_name}}</p>
<p>Você requisitou a alteração de senha da sua conta {{ config('app.name') }}. Por favor clique no link abaixo.</p>

<table
    role="presentation"
    class="btn btn-primary"
>
    <tbody>
        <tr>
            <td>
                <table role="presentation">
                    <tbody>
                        <tr>
                            <td><a href="{{ $resetPasswordLink }}" target="_blank">REDEFINIR SENHA</a></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<p>Por favor, ignore este email se você não requisitou alteração de senha.</p>
