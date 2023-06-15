<?php

namespace App\Http\Controllers;

use Google\Service\Sheets;
use Google\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

class Googlesheet extends Controller
{
    //
    public function index()
    {
        // Set up the client object
        $client = new Client();
        $client->setApplicationName('Google Sheets API PHP Insert');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(base_path('google_credentials.json')); // Replace with your own credentials file path
        // Set up the service object
        $service = new Sheets($client);

        // Define the spreadsheet ID and range
        $spreadsheetId = "1m3UR1_YbrdPWRorDN33-_blCj6uhB7NEOBhn5vYEkMk";
        // dd($spreadsheetId);
        $range = "Sheet1!A2:D";

        // Get the existing data from the sheet
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();


        // Get the last row number and next entry ID
        $lastRowNum = count($values) + 1;
        $nextEntryId = 9;

        // Define the new row data
        $newRowData = [$nextEntryId, 'aaa', 'bbb', 'ccc'];

        // Insert the new row at the correct position
        if ($nextEntryId > $values[$lastRowNum - 2][0]) {
            array_push($values, $newRowData);
        } else {
            for ($i = 1; $i < $lastRowNum; $i++) {
                $entryId = intval($values[$i - 1][0]);
                if ($nextEntryId < $entryId) {
                    array_splice($values, $i - 1, 0, [$newRowData]); // Insert new row at index $i-1
                    break;
                }
            }
        }
        if (count($values) == $lastRowNum - 1) {
            $values[] = $newRowData; // Append new row to the end if needed
        }
        // Update the sheet with the new data
        $updateRange = 'Sheet1!A2:D' . (count($values) + 1);
        $requestBody = new Sheets\ValueRange([
            'range' => $updateRange,
            'values' => $values
        ]);
        $options = ['valueInputOption' => 'USER_ENTERED'];
        $service->spreadsheets_values->update($spreadsheetId, $updateRange, $requestBody, $options);
        return view('welcome');
    }
    public function update_data(Request $request)
    {
        $input_data = $request->except('_token');
        $client = new Client();
        $client->setApplicationName('Google Sheets API PHP Insert');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(base_path('google_credentials.json')); // Replace with your own credentials file path
        // Set up the service object
        $service = new Sheets($client);

        // Define the spreadsheet ID and range
        $spreadsheetId = "1m3UR1_YbrdPWRorDN33-_blCj6uhB7NEOBhn5vYEkMk";
        // dd($spreadsheetId);
        $range = "Sheet1!A2:D";

        // Get the existing data from the sheet
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();


        // Get the last row number and next entry ID
        $lastRowNum = count($values) + 1;
        $nextEntryId = (int) $input_data["row1"];
        // Define the new row data
        $newRowData = [$nextEntryId, $input_data['row2'], $input_data['row3'], $input_data['row4']];
        // Insert the new row at the correct position
        if ($nextEntryId > $values[$lastRowNum - 2][0]) {
            array_push($values, $newRowData);
        } else {
            for ($i = 1; $i < $lastRowNum; $i++) {
                $entryId = intval($values[$i - 1][0]);
                if ($nextEntryId < $entryId) {
                    array_splice($values, $i - 1, 0, [$newRowData]); // Insert new row at index $i-1
                    break;
                }
            }
        }
        if (count($values) == $lastRowNum - 1) {
            $values[] = $newRowData; // Append new row to the end if needed
        }
        // Update the sheet with the new data
        $updateRange = 'Sheet1!A2:D' . (count($values) + 1);
        $requestBody = new Sheets\ValueRange([
            'range' => $updateRange,
            'values' => $values
        ]);
        $options = ['valueInputOption' => 'USER_ENTERED'];
        $service->spreadsheets_values->update($spreadsheetId, $updateRange, $requestBody, $options);
        echo "insert success";
    }
}
