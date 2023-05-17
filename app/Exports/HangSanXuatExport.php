<?php

namespace App\Exports;

use App\Models\HangSanXuat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HangSanXuatExport implements FromCollection, WithHeadings, WithMapping
{
	public function headings(): array
	{
		return [
			'id',
			'tenhang',
			'tenhang_slug',
			'hinhanh',
			'created_at',
			'updated_at'
		];
	}
	
	public function map($row): array
	{
		return [
			$row->id,
			$row->tenhang,
			$row->tenhang_slug,
			$row->hinhanh,
			$row->created_at,
            $row->updated_at
		];
	}
	
	/**
	* @return \Illuminate\Support\Collection
	*/
	public function collection()
	{
		return HangSanXuat::all();
	}
}