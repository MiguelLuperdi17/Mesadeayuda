<!-- resources/views/emails/test.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $data['subject'] }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <h4>Registro nuevo - Mesa de ayuda</h4>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 10px;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; padding: 30px;">

                    {{-- Logo opcional --}}
                    @if(!empty($data['logo']))
                        <tr>
                            <td align="center" style="padding-bottom: 20px;">
                                <img src="{{ $data['logo'] }}" alt="Logo" width="50%">
                            </td>
                        </tr>
                    @endif

                    {{-- Título --}}
                    @if(!empty($data['titulo']))
                        <tr>
                            <td style="font-size: 20px; font-weight: bold; color: #333; padding-bottom: 10px;">
                                {{ $data['titulo'] }}
                            </td>
                        </tr>
                    @endif

                    {{-- Contenido principal (HTML permitido) --}}
                    <tr>
                        <td style="font-size: 16px; color: #555; padding-bottom: 10px;">
                            {!! $data['contenido'] !!}
                        </td>
                    </tr>

                    {{-- Botón o enlace --}}
                    @if(!empty($data['enlace']) && !empty($data['enlace_texto']))
                        <tr>
                            <td align="center" style="padding: 20px 0;">
                                <!--[if mso]>
                                <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $data['enlace'] }}" style="height:40px;v-text-anchor:middle;width:160px;" arcsize="10%" stroke="f" fillcolor="#FF5733">
                                    <w:anchorlock/>
                                    <center style="color:#ffffff;font-family:sans-serif;font-size:16px;font-weight:bold;">
                                        {{ $data['enlace_texto'] }}
                                    </center>
                                </v:roundrect>
                                <![endif]-->
                                <![if !mso]>
                                <a href="{{ $data['enlace'] }}"
                                   style="background-color:#FF5733;border:1px solid #FF5733;border-radius:5px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:16px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:160px;-webkit-text-size-adjust:none;mso-hide:all;">
                                   {{ $data['enlace_texto'] }}
                                </a>
                                <![endif]>
                            </td>
                        </tr>
                    @endif

                    {{-- Footer --}}
                    @if(!empty($data['footer']))
                        <tr>
                            <td style="font-size: 14px; color: #888; padding-top: 10px;">
                                {{ $data['footer'] }}
                            </td>
                        </tr>
                    @endif

                    {{-- Firma --}}
                    @if(!empty($data['firma']))
                        <tr>
                            <td style="font-size: 16px; color: #555; padding-top: 10px;">
                                {!! $data['firma'] !!}
                            </td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>
</body>
</html>