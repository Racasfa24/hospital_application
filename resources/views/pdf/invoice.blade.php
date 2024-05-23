<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado Médico</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .certificate-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 36px;
            margin: 0;
            color: #000;
        }
        .header p {
            font-size: 18px;
            margin: 5px 0;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            font-size: 18px;
            line-height: 1.5;
            margin: 10px 0;
        }
        .signature-section {
            margin-top: 40px;
            text-align: right;
        }
        .signature {
            font-size: 18px;
            font-weight: bold;
            margin-top: 40px;
            text-align: center;
        }
        .signature-line {
            display: block;
            width: 200px;
            height: 1px;
            background-color: #000;
            margin: 10px auto;
        }
    </style>
</head>
<body>
<div class="certificate-container">
    <div class="header">
        <h1>Certificado Médico</h1>
        <p>Fecha: {{ $medicalCertificate->date }}</p>
    </div>
    <div class="content">
        <p><strong>Edad del Paciente:</strong> {{ $medicalCertificate->age }} años</p>
        <p><strong>Altura:</strong> {{ $medicalCertificate->height }} cm</p>
        <p><strong>Peso:</strong> {{ $medicalCertificate->weight }} kg</p>
        <p><strong>Presión Sistólica:</strong> {{ $medicalCertificate->systolic_pressure }} mmHg</p>
        <p><strong>Presión Diastólica:</strong> {{ $medicalCertificate->diastolic_pressure }} mmHg</p>
        <p><strong>Frecuencia Cardíaca:</strong> {{ $medicalCertificate->heart_rate }} latidos por minuto</p>
        <p><strong>Frecuencia Respiratoria:</strong> {{ $medicalCertificate->respiratory_rate }} respiraciones por minuto</p>
        <p><strong>Paciente:</strong> {{ $medicalCertificate->patient->name }} {{ $medicalCertificate->patient->lastname }}</p>
    </div>
    <div class="signature-section">
        <div class="signature-line"></div>
        <p class="signature">{{ $medicalCertificate->doctor->name }} {{ $medicalCertificate->doctor->lastname }}</p>
        <p class="signature">Firma del Doctor</p>
    </div>
</div>
</body>
</html>
